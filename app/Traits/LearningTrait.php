<?php

namespace App\Traits;

use Redis;
use App\Chapitre;
use App\Session;

trait LearningTrait
{
    /**
     * Marque une session comme terminée par le user
     *
     * @param [App\Session] $session
     * @return void
     */
    public function terminerSession($session) {
        // Set Add
        Redis::sadd("user:{$this->id}:chapitre:{$session->chapitre->id}", $session->id);
    }

    /**
     * Obtenir un tableau de sessions terminées pour un chapitre
     *
     * @param [App\Chapitre] $chapitre
     * @return array
     */
    public function getSessionsTermineesPourChapitre($chapitre) {
        return Redis::smembers("user:{$this->id}:chapitre:{$chapitre->id}");
    }

    /**
     * Get number of completed lessons for a series
     * Obtenir nombre de sessions terminées pour un chapitre
     *
     * @param [App\Chapitre] $chapitre
     * @return integer
     */
    public function getNombreSessionsTermineesPourChapitre($chapitre) {
        return count($this->getSessionsTermineesPourChapitre($chapitre));
    }

    /**
     * Obtenir le pourcentage terminé d'un cahpitre par un User
     *
     * @param [App\Chapitre] $chapitre
     * @return void
     */
    public function pourcentageTerminePourChapitre($chapitre) {
        $nbSessionsDuChapitre = $chapitre->Sessions->count();
        $nbSessionsTerminees = $this->getNombreSessionsTermineesPourChapitre($chapitre);

        return ($nbSessionsTerminees / $nbSessionsDuChapitre) * 100;
    }

    /**
     * Vérifie si le user a démarré un chapitre donné
     *
     * @param [App\Chapitre] $chapitre
     * @return boolean
     */
    public function aDemarreLeChapitre($chapitre) {
        return $this->getNombreSessionsTermineesPourChapitre($chapitre) > 0;
    }

    /**
     * Obtenir toutes les sessions terminées pour un chapitre
     *
     * @param [App\Chapitre] $chapitre
     * @return \Illuminate\Support\Collection(App\Session)
     */
    public function getSessionsTerminees($chapitre) {
        // 1, 2, 4
        return Session::whereIn('id',
            $this->getSessionsTermineesPourChapitre($chapitre)
        )->get();
    }

    /**
     * Check si un user a terminé une session
     *
     * @param [App\Session] $session
     * @return boolean
     */
    public function aTermineeSession($session) {
        return in_array(
            $session->id,
            $this->getSessionsTermineesPourChapitre($session->chapitre)
        );
    }


    /**
     *  COURS
     */

     /**
      * Vérifie si le user a démarré un cour donné
      *
      * @param [App\Cour] $cour
      * @return boolean
      */
     public function aDemarreLeCours($cour) {
         $nbChapitresDemarres = 0;
         foreach ($cour->chapitres as $chapitre) {
            $nbChapitresDemarres += ($this->aDemarreLeChapitre($chapitre) ? 1 : 0);
         }

         return ($nbChapitresDemarres > 0);
     }
}
