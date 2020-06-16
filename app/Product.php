<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @return array
     */
    protected $casts = [
        'price' => 'float',
    ];
}
