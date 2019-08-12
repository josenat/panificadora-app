<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Factura
 * @package App\Models
 * @version August 9, 2019, 7:10 pm UTC
 *
 * @property integer cliente_id
 * @property string fecha
 */
class Factura extends Model
{
    use SoftDeletes;

    public $table = 'facturas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cliente_id',
        'fecha',
        'deuda'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cliente_id' => 'integer',
        'fecha' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cliente_id' => 'required',
        'fecha' => 'required'
    ];

    
}
