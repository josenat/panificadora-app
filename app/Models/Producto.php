<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Producto
 * @package App\Models
 * @version August 9, 2019, 7:23 pm UTC
 *
 * @property integer categoria_id
 * @property string nombre
 * @property float precio
 * @property integer stock
 * @property string codigo
 */
class Producto extends Model
{
    use SoftDeletes;

    public $table = 'productos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'categoria_id',
        'nombre',
        'precio',
        'stock',
        'codigo',
        'estado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'categoria_id' => 'integer',
        'nombre' => 'string',
        'precio' => 'double',
        'stock' => 'integer',
        'codigo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'categoria_id' => 'required',
        'nombre' => 'required',
        'precio' => 'required',
    ];

    
}
