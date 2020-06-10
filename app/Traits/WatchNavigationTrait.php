<?php

namespace App\Traits;

/**
 * Ce trait permet de gérer la navigation et prendre la décision ou non de lancer un quiz après avant une session
 * @var [type]
 */
trait WatchNavigationTrait
{
    protected $prev_link;
    protected $curr_link;
    protected $next_link;

    protected $prev_elem_id;
    protected $curr_elem_class;
    protected $next_session;

    public function getNextLink() {
        return $this->next_link;
    }

    public function setNextLink($next_session) {
        // on assigne la session suivante
        $this->next_session = $next_session;
        // on recupère la classe qui implémente ce trait
        $this->curr_elem_class = str_replace("App\\", "", get_called_class());

        // si l'élément actuelle est une session
        if ($this->curr_elem_class == "Session") {
            // si cette session a un quiz complet
            if ($this->quiz && $this->quiz->is_complet) {
                // le prochain lien mènera vers ce quiz
                $this->next_link = route('quizs.do', ['quiz_by_id' => $this->quiz->id]);
            } else {
                // sinon on traite les dépendances de cette session
                $this->setLinkSession($this);
            }
        } else {
            // si l'élément actuelle est un quiz
            if ($this->session) {
                // quiz de session
                $this->setLinkSession($this->session);
            } elseif ($this->chapitre) {
                // quiz de chapitre
                $this->setLinkCour($this->chapitre->cour);
            } else {
                // quiz de cour
                // le prochain c'est la fin du cours
                $this->next_link = route('cours.fin', ['cour' => $chapitre->cour]);
            }
        }
    }

    private function setLinkSession($session) {
        // si la session de ce quiz est la dernière de son chapitre ...
        if ($session->estDerniereDuChapitre()) {
            // on traite le chapitre et ses dépendances
            $this->setLinkChapitre($session->chapitre);
        } else {
            // sinon, le prochain lien menera à la prochaine session
            $this->setLinkNextSession();
        }
    }

    private function setLinkChapitre($chapitre) {
        // si le chapitre (paramètre) a un quiz complet
        if ($chapitre->quiz && $chapitre->quiz->is_complet) {
            // alors le prochain lien menera au quiz de ce chapitre
            $this->next_link = route('quizs.do', ['quiz_by_id' => $chapitre->quiz->id]);
        } elseif ($chapitre->estDernierDuCour()) {
            // sinon, si ce chapitre est le dernier du cours
            // on traite les dépendances du cours
            $this->setLinkCour($chapitre->cour);
        } else {
            // sinon, le prochain lien menera à la prochaine session
            $this->setLinkNextSession();
        }
    }

    private function setLinkCour($cour) {
        if ($cour->quiz && $cour->quiz->is_complet) {
            $this->next_link = route('quizs.do', ['quiz_by_id' => $cour->quiz->id]);
        } else {
            // sinon,
            // le prochain lien menera vers la page de fin de cours
            $this->next_link = route('cours.fin', ['cour' => $cour]);
        }
    }

    private function setLinkNextSession() {
        route('cours.watch', ['chapitre' => $this->next_session->chapitre, 'session' => $this->next_session->id]);
    }
}
