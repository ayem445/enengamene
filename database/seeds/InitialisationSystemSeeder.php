<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Difficulte;
use App\Matiere;
use App\NiveauEtude;
use App\Notation;
use App\QuizTypeQuestion;
use App\TypeContenu;
use App\TypeEtablissement;

class InitialisationSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertion Difficultés
        foreach ($this->dfficultes_list() as $difficulte) {
          $difficulte_db = Difficulte::where('libelle',$difficulte['libelle'])->where('level',$difficulte['level'])->first();

          if ($difficulte_db) {

          } else {
            $difficulte['code'] = uniqid(Str::slug($difficulte['libelle']), true);
            $difficulte_new = Difficulte::create($difficulte);
            $difficulte_new->setCodeWithId($difficulte['libelle']);
          }
        }

        // Insertion Matières
        foreach ($this->matieres_list() as $matiere) {
          $matiere_db = Matiere::where('libelle',$matiere['libelle'])->first();

          if ($difficulte_db) {

          } else {
            $matiere['code'] = uniqid(Str::slug($matiere['libelle']), true);
            $matiere_new = Matiere::create($matiere);
            $matiere_new->setCodeWithId($matiere['libelle']);
          }
        }

        // Insertion Niveaux d'étude
        foreach ($this->niveauetudes_list() as $niveau_etude) {
          $niveau_etude_db = NiveauEtude::where('libelle',$niveau_etude['libelle'])->first();

          if ($niveau_etude_db) {

          } else {
            $niveau_etude['code'] = uniqid(Str::slug($niveau_etude['libelle']), true);
            $niveau_etude_new = NiveauEtude::create($niveau_etude);
            $niveau_etude_new->setCodeWithId($niveau_etude['libelle']);
          }
        }

        // Insertion Notations
        foreach ($this->notations_list() as $notation) {
          $notation_db = Notation::where('libelle',$notation['libelle'])->first();

          if ($notation_db) {

          } else {
            $notation['code'] = uniqid(Str::slug($notation['libelle']), true);
            $notation_new = Notation::create($notation);
            $notation_new->setCodeWithId($notation['libelle']);
          }
        }

        // Insertion Types Question de Quiz
        foreach ($this->quiztypequestions_list() as $quiztypequestion) {
          $quiztypequestion_db = QuizTypeQuestion::where('libelle',$quiztypequestion['libelle'])->first();

          if ($quiztypequestion_db) {

          } else {
            $quiztypequestion['code'] = uniqid(Str::slug($quiztypequestion['libelle']), true);
            $quiztypequestion_new = QuizTypeQuestion::create($quiztypequestion);
            $quiztypequestion_new->setCodeWithId($quiztypequestion['libelle']);
          }
        }

        // Insertion Types de Contenu
        foreach ($this->typecontenus_list() as $typecontenu) {
          $typecontenu_db = TypeContenu::where('libelle',$typecontenu['libelle'])->first();

          if ($typecontenu_db) {

          } else {
            $typecontenu['code'] = uniqid(Str::slug($typecontenu['libelle']), true);
            $typecontenu_new = TypeContenu::create($typecontenu);
            $typecontenu_new->setCodeWithId($typecontenu['libelle']);
          }
        }

        // Insertion Types Etablissement
        foreach ($this->typeetablissements_list() as $typeetablissement) {
          $typeetablissement_db = TypeEtablissement::where('libelle',$typeetablissement['libelle'])->first();

          if ($typeetablissement_db) {

          } else {
            $typeetablissement['code'] = uniqid(Str::slug($typeetablissement['libelle']), true);
            $typeetablissement_new = TypeEtablissement::create($typeetablissement);
            $typeetablissement_new->setCodeWithId($typeetablissement['libelle']);
          }
        }
    }

    private function dfficultes_list() {
        return [
            ['libelle' => "Très Facile", 'level' => 1, 'code' =>"" ],
            ['libelle' => "Facile", 'level' => 2, 'code' =>"" ],
            ['libelle' => "Normale",'level' => 3, 'code' =>"" ],
            ['libelle' => "Difficile",'level' => 4, 'code' =>"" ],
            ['libelle' => "Très Dfficile",'level' => 5, 'code' =>"" ],
        ];
    }

    private function matieres_list() {
        return [
            ['libelle' => "Français", 'description' => "", 'code' =>"" ],
            ['libelle' => "Mathématiques",'description' => "", 'code' =>"" ],
            ['libelle' => "SVT",'description' => "Science de la vie ", 'code' =>"" ],
            ['libelle' => "Sciences Physiques",'description' => "Science de la vie ", 'code' =>"" ],
            ['libelle' => "Anglais",'description' => "", 'code' =>"" ],
            ['libelle' => "Espagnol",'description' => "", 'code' =>"" ],
            ['libelle' => "Histoire",'description' => "", 'code' =>"" ],
            ['libelle' => "Géographie",'description' => "", 'code' =>"" ],
        ];
    }

    private function niveauetudes_list() {
        return [
            ['libelle' => "6ème", 'level'=> 1, 'code' =>"" ],
            ['libelle' => "5ème", 'level'=> 2, 'code' =>"" ],
            ['libelle' => "4ème", 'level'=> 3, 'code' =>"" ],
            ['libelle' => "3ème", 'level'=> 4, 'code' =>"" ],
            ['libelle' => "2nd", 'level'=> 5, 'code' =>"" ],
            ['libelle' => "1ère", 'level'=> 6, 'code' =>"" ],
            ['libelle' => "Tle", 'level'=> 7, 'code' =>"" ],
        ];
    }

    private function notations_list() {
        return [
            ['libelle' => "Passable", 'level' => 1, 'code' =>"" ],
            ['libelle' => "Satisfaisant", 'level' => 2, 'code' =>"" ],
            ['libelle' => "Bien", 'level' => 3, 'code' =>"" ],
            ['libelle' => "Très Bien", 'level' => 4, 'code' =>"" ],
            ['libelle' => "Excellent", 'level' => 5, 'code' =>"" ],
        ];
    }

    private function quiztypequestions_list() {
        return [
          ['libelle' => "Choix-Multiple", 'description' => "la(les) réponse(s) à ce type de question se trouve parmis une liste de réponses proposée", 'code' =>"" ],
          ['libelle' => "Texte-Match", 'description' => "la réponse doit être saisie pour correspondre aux éléments de réponse (qui ne seront pas affichés)", 'code' =>"" ],
        ];
    }

    private function typecontenus_list() {
        return [
          ['libelle' => "Video", 'description' => "vidéo à Uploader dans l Application", 'code' =>"" ],
          ['libelle' => "Texte", 'description' => "simple texte à saisir", 'code' =>"" ],
        ];
    }

    private function typeetablissements_list() {
        return [
          ['libelle' => "Lycée/Collège", 'description' => "lycée ou collège de l enseignement général ou technique", 'code' =>"" ],
          ['libelle' => "Ecole Supérieure", 'description' => "Ecole Supérieure", 'code' =>"" ],
        ];
    }
}
