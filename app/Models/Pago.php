<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pago
 * @package App\Models
 * @version August 9, 2019, 7:14 pm UTC
 *
 * @property integer factura_id
 * @property integer modo_pago_id
 * @property float monto
 * @property string observacion
 */
class Pago extends Model
{
    use SoftDeletes;

    public $table = 'pagos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'factura_id',
        'modo_pago_id',
        'monto',
        'observacion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'factura_id' => 'integer',
        'modo_pago_id' => 'integer',
        'monto' => 'double',
        'observacion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'factura_id' => 'required',
        'modo_pago_id' => 'required',
        'monto' => 'required'
    ];

    
}
