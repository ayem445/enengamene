<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Trait de base destiné à être implimenté par tous les Modèles du Système
 * Ce Trait doit aussi implémenter tous les traits destinés à être implémentés par tous les modèles du Système
 * @var [type]
 */
trait BaseTrait
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
}
