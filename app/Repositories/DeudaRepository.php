<?php

namespace App\Repositories;

use App\Models\Deuda;
use App\Repositories\BaseRepository;

/**
 * Class DeudaRepository
 * @package App\Repositories
 * @version August 9, 2019, 7:01 pm UTC
*/

class DeudaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'monto',
        'cliente_dni'
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
        return Deuda::class;
    }
}
