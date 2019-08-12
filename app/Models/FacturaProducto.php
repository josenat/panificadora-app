<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FacturaProducto
 * @package App\Models
 * @version August 9, 2019, 7:19 pm UTC
 *
 * @property integer factura_id
 * @property integer producto_id
 * @property integer cantidad
 * @property float precio
 */
class FacturaProducto extends Model
{
    use SoftDeletes;

    public $table = 'factura_productos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'factura_id',
        'producto_id',
        'cantidad',
        'precio'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'factura_id' => 'integer',
        'producto_id' => 'integer',
        'cantidad' => 'integer',
        'precio' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'factura_id' => 'required',
        'producto_id' => 'required',
        'cantidad' => 'required',
        'precio' => 'required'
    ];

    
}
