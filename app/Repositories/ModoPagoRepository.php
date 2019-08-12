<?php

namespace App\Repositories;

use App\Models\ModoPago;
use App\Repositories\BaseRepository;

/**
 * Class ModoPagoRepository
 * @package App\Repositories
 * @version August 9, 2019, 7:15 pm UTC
*/

class ModoPagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
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
        return ModoPago::class;
    }
}
