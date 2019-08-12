<?php

namespace App\Repositories;

use App\Models\FacturaProducto;
use App\Repositories\BaseRepository;

/**
 * Class FacturaProductoRepository
 * @package App\Repositories
 * @version August 9, 2019, 7:19 pm UTC
*/

class FacturaProductoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'factura_id',
        'producto_id',
        'cantidad',
        'precio'
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
        return FacturaProducto::class;
    }
}
