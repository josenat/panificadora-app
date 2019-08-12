<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EstadoCliente
 * @package App\Models
 * @version August 11, 2019, 2:44 am UTC
 *
 * @property string dni
 * @property string nombre
 * @property string telefono
 * @property string correo
 * @property float deuda
 */
class EstadoCliente extends Model
{
    public $table = 'estado_clientes_v';
    
    
    public $fillable = [
        'dni',
        'nombre',
        'telefono',
        'correo',
        'deuda'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dni' => 'string',
        'nombre' => 'string',
        'telefono' => 'string',
        'correo' => 'string',
        'deuda' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
