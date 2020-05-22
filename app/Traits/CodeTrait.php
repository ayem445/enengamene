<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait CodeTrait
{
    // Met à jour le code d'un modèle pour utiliser l id
    public function setCodeWithId($prefix = "") {
      // Si le préfixe est vide ...
      if ($prefix == "") {
          // ... on utilise l'id unique de PHP et l'id du modèle pour créer le code
          $this->code = uniqid("", true) . "_" . $this->id;
      } else {
          // Sinon, on concatène le préfixe et l'id pour créer le code
          $this->code = Str::slug($prefix) . "_" . $this->id;
      }
      // On enregistre les modifications apportées au modèle
      $this->save();
    }

    /**
     * Retourne un code unique pour le modèle
     * @return string code alphanumérique
     */
    public static function getUniqcode() {
      $caller_class_full = get_called_class();
      $caller_class = str_replace("App\\", "", $caller_class_full);
      return Str::slug($caller_class) . "_" . uniqid("", true);
    }
}
