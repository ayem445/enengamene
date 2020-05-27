<?php

namespace App\Traits;

use Redis;
use App\Cour;
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
        Redis::sadd("user:{$this->id}:cour:{$session->chapitre->cour_id}:chapitre:{$session->chapitre->id}", $session->id);
    }

    /**
     * Obtenir un tableau de sessions terminées pour un chapitre
     *
     * @param [App\Chapitre] $chapitre
     * @return array
     */
    public function getSessionsTermineesPourChapitre($chapitre) {
        return Redis::smembers("user:{$this->id}:cour:{$chapitre->cour_id}:chapitre:{$chapitre->id}");
    }

    /**
     * Obtenir un tableau de sessions terminées pour un cours
     *
     * @param [App\Cour] $cour
     * @return array
     */
    public function getSessionsTermineesPourCours($cour) {
        $keys = Redis::keys("user:{$this->id}:cour:{$cour->id}:chapitre:*");
        $result_arr = [];
        foreach ($keys as $key) {
            $chapitreId = explode(':', $key)[5];
            $new_list = Redis::smembers("user:{$this->id}:cour:{$cour->id}:chapitre:{$chapitreId}");
            $result_arr  += $new_list;
        }
        return $result_arr;
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
     * Get number of completed lessons for a series
     * Obtenir nombre de sessions terminées pour un chapitre
     *
     * @param [App\Chapitre] $chapitre
     * @return integer
     */
    public function getNombreSessionsTermineesPourCours($cour) {
        return count($this->getSessionsTermineesPourCours($cour));
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
     * Obtenir le nombre total de sessions que l'utilisateur a déjà terminées
     *
     * @return integer
     */
    public function getNombreTotalSessionsTerminees() {
        $keys = Redis::keys("user:{$this->id}:cour:*");
        $result = 0;
        foreach($keys as $key):
            $courId = explode(':', $key)[3];
            $chapitreId = explode(':', $key)[5];
            $result = $result + count(Redis::smembers("user:{$this->id}:cour:{$courId}:chapitre:{$chapitreId}"));
        endforeach;

        return $result;
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
         return $this->getNombreSessionsTermineesPourCours($cour) > 0;
     }

     /**
      * Obtenir tous les Ids des cours en cours de visionnage
      *
      * @return array
      */
     public function coursEnVisionnageIds() {
         $keys = Redis::keys("user:{$this->id}:cour:*");
         $coursIds = [];
         foreach($keys as $key):
             $coursId = explode(':', $key)[3];
             array_push($coursIds, $coursId);
         endforeach;

         return $coursIds;
     }

     /**
      * Obtenir tous les cours en cours de visionnage
      *
      * @return void
      */
     public function coursEnVisionnage() {
         return collect($this->coursEnVisionnageIds())->map(function($id){
             return Cour::find($id);
         })->filter(); // filter(): pour lister uniquement les valeurs non nulles
     }
}
