<?php

namespace App\Repositories;

use App\Models\Factura;
use App\Repositories\BaseRepository;

/**
 * Class FacturaRepository
 * @package App\Repositories
 * @version August 9, 2019, 7:10 pm UTC
*/

class FacturaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cliente_id',
        'fecha',
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
        return Factura::class;
    }
}
