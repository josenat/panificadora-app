<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cliente
 * @package App\Models
 * @version August 9, 2019, 6:56 pm UTC
 *
 * @property string dni
 * @property string nombre
 * @property string apellido
 * @property string direccion
 * @property string telefono
 * @property string correo
 */
class Cliente extends Model
{
    use SoftDeletes;

    public $table = 'clientes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'dni',
        'nombre',
        'apellido',
        'direccion',
        'telefono',
        'correo',
        'estado_id'
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
        'apellido' => 'string',
        'direccion' => 'string',
        'telefono' => 'string',
        'correo' => 'string',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dni' => 'required',
        'nombre' => 'required',
        'apellido' => 'required'
    ];

}
