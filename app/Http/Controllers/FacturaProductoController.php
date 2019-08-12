<?php

namespace App\Http\Controllers;

use App\DataTables\FacturaProductoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFacturaProductoRequest;
use App\Http\Requests\UpdateFacturaProductoRequest;
use App\Repositories\FacturaProductoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FacturaProductoController extends AppBaseController
{
    /** @var  FacturaProductoRepository */
    private $facturaProductoRepository;

    public function __construct(FacturaProductoRepository $facturaProductoRepo)
    {
        $this->facturaProductoRepository = $facturaProductoRepo;
    }

    /**
     * Display a listing of the FacturaProducto.
     *
     * @param FacturaProductoDataTable $facturaProductoDataTable
     * @return Response
     */
    public function index(FacturaProductoDataTable $facturaProductoDataTable)
    {
        return $facturaProductoDataTable->render('factura_productos.index');
    }

    /**
     * Show the form for creating a new FacturaProducto.
     *
     * @return Response
     */
    public function create()
    {
        return view('factura_productos.create');
    }

    /**
     * Store a newly created FacturaProducto in storage.
     *
     * @param CreateFacturaProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateFacturaProductoRequest $request)
    {
        $input = $request->all();

        $facturaProducto = $this->facturaProductoRepository->create($input);

        Flash::success('Factura Producto saved successfully.');

        return redirect(route('facturaProductos.index'));
    }

    /**
     * Display the specified FacturaProducto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $facturaProducto = $this->facturaProductoRepository->find($id);

        if (empty($facturaProducto)) {
            Flash::error('Factura Producto not found');

            return redirect(route('facturaProductos.index'));
        }

        return view('factura_productos.show')->with('facturaProducto', $facturaProducto);
    }

    /**
     * Show the form for editing the specified FacturaProducto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $facturaProducto = $this->facturaProductoRepository->find($id);

        if (empty($facturaProducto)) {
            Flash::error('Factura Producto not found');

            return redirect(route('facturaProductos.index'));
        }

        return view('factura_productos.edit')->with('facturaProducto', $facturaProducto);
    }

    /**
     * Update the specified FacturaProducto in storage.
     *
     * @param  int              $id
     * @param UpdateFacturaProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacturaProductoRequest $request)
    {
        $facturaProducto = $this->facturaProductoRepository->find($id);

        if (empty($facturaProducto)) {
            Flash::error('Factura Producto not found');

            return redirect(route('facturaProductos.index'));
        }

        $facturaProducto = $this->facturaProductoRepository->update($request->all(), $id);

        Flash::success('Factura Producto updated successfully.');

        return redirect(route('facturaProductos.index'));
    }

    /**
     * Remove the specified FacturaProducto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $facturaProducto = $this->facturaProductoRepository->find($id);

        if (empty($facturaProducto)) {
            Flash::error('Factura Producto not found');

            return redirect(route('facturaProductos.index'));
        }

        $this->facturaProductoRepository->delete($id);

        Flash::success('Factura Producto deleted successfully.');

        return redirect(route('facturaProductos.index'));
    }
}
