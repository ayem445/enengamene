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
    use CodeTrait, ListTrait, ImageTrait, DateTimeTrait;

    /**
     * Retourne l'actuel object du modèle mappé
     * @param  [type] $label libellé du modèle appellant
     * @return [type]        objet mappé
     */
    public function mapped($label) {
        return ["id" => $this->id,"libelle" => $this->{$label}];
    }
}
