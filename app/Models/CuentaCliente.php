<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CuentaCliente
 * @package App\Models
 * @version August 11, 2019, 12:49 am UTC
 *
 * @property string fecha
 * @property string dni
 * @property string cliente
 * @property string producto
 * @property integer cantidad
 * @property float costo
 * @property float importe
 * @property string modo
 * @property float deuda
 */
class CuentaCliente extends Model
{
    public $table = 'cuenta_clientes_v';

    public $fillable = [
        'fecha',
        'dni',
        'cliente',
        'producto',
        'cantidad',
        'costo',
        'importe',
        'modo',
        'deuda'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'datetime',
        'dni' => 'string',
        'cliente' => 'string',
        'producto' => 'string',
        'cantidad' => 'integer',
        'costo' => 'double',
        'importe' => 'double',
        'modo' => 'string',
        'deuda' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getFechaAttribute($date)
    {
        // formatear fecha del siguiente modo para que pueda ser leída por DataTables JS 
        list($DD, $MM, $YYYY) = explode("/", date('d/m/Y', strtotime($date)));   
        $DD   = (int) $DD;
        $MM   = (int) $MM;
        $YYYY = (int) $YYYY;     
        $DD   = ($DD < 10) ? '0'.$DD : $DD;
        $MM   = ($MM < 10) ? '0'.$MM : $MM;

        list($x, $time) = explode(" ", $date);
        list($hh, $mm)  = explode(":", $time);   

        return $DD . '-' . $MM . '-' . $YYYY .' '. $hh .':'. $mm;        
        
        // si no será leída por DataTables JS puede usar el siguiente código:
        // return \Carbon\Carbon::parse($date)->format('m/d/Y'); // devolverá: d-m-Y 
    } 
}
