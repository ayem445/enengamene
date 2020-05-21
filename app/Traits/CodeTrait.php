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

    public static function getUniqcode($prefix = "") {
      // Si le préfixe est vide ...
      if ($prefix == "") {
          // ... on retourne le code unique simplement
          return uniqid("", true);
      } else {
          // Sinon, on concatène le préfixe et le code unique
          return Str::slug($prefix) . "_" . uniqid("", true);
      }
    }
}
