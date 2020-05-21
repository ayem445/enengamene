<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait ListTrait
{
    /**
     * Retourne une liste des éléments de la classe (modèle) mappée ["id","libelle"]
     * @param  string $label libellé du modèle appellant
     * @return [type]        la liste mappée
     */
    public static function listMap($label) {
        // Récupération de la clsse appellante
        $caller_class_full = get_called_class();
        // Récupération de la table du modèle appellant
        $model_table = with(New $caller_class_full)->getTable();

        // Récupération de la liste des éléments
        //$raw_list = DB::table($model_table)->orderBy($label, 'asc')->get();
        $raw_list = $caller_class_full::get();
        //dd($raw_list,$tmp_list);
        // Maping des éléments récupérés
        $final_list = $raw_list->map(function($list)  use($label) {
          return ["id" => $list->id,"libelle" => $list->{$label}];
        });
        return $final_list;
    }
}
