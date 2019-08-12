<?php

namespace App\Repositories;

use App\Models\EstadoCliente;
use App\Repositories\BaseRepository;

/**
 * Class EstadoClienteRepository
 * @package App\Repositories
 * @version August 11, 2019, 2:44 am UTC
*/

class EstadoClienteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'dni',
        'nombre',
        'telefono',
        'correo',
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
        return EstadoCliente::class;
    }
}
