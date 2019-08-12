<?php

namespace App\Repositories;

use App\Models\CuentaCliente;
use App\Repositories\BaseRepository;

/**
 * Class CuentaClienteRepository
 * @package App\Repositories
 * @version August 11, 2019, 12:49 am UTC
*/

class CuentaClienteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CuentaCliente::class;
    }
}
