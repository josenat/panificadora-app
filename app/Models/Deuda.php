<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Deuda
 * @package App\Models
 * @version August 9, 2019, 7:01 pm UTC
 *
 * @property string fecha
 * @property float monto
 * @property integer cliente_id
 */
class Deuda extends Model
{
    public $table = 'deudas';


    public $fillable = [
        'fecha',
        'monto',
        'cliente_dni',
        'estado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'date',
        'monto' => 'double',
        'cliente_id' => 'integer',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fecha' => 'required',
        'monto' => 'required',
        'cliente_dni' => 'required'
    ];

    
}
