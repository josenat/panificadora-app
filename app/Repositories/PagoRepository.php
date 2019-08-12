<?php

namespace App\Repositories;

use App\Models\Pago;
use App\Repositories\BaseRepository;

/**
 * Class PagoRepository
 * @package App\Repositories
 * @version August 9, 2019, 7:14 pm UTC
*/

class PagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'factura_id',
        'modo_pago_id',
        'monto',
        'observacion'
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
        return Pago::class;
    }
}
