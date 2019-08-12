<?php

namespace App\Http\Controllers;

use App\DataTables\ModoPagoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateModoPagoRequest;
use App\Http\Requests\UpdateModoPagoRequest;
use App\Repositories\ModoPagoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ModoPagoController extends AppBaseController
{
    /** @var  ModoPagoRepository */
    private $modoPagoRepository;

    public function __construct(ModoPagoRepository $modoPagoRepo)
    {
        $this->modoPagoRepository = $modoPagoRepo;
    }

    /**
     * Display a listing of the ModoPago.
     *
     * @param ModoPagoDataTable $modoPagoDataTable
     * @return Response
     */
    public function index(ModoPagoDataTable $modoPagoDataTable)
    {
        return $modoPagoDataTable->render('modo_pagos.index');
    }

    /**
     * Show the form for creating a new ModoPago.
     *
     * @return Response
     */
    public function create()
    {
        return view('modo_pagos.create');
    }

    /**
     * Store a newly created ModoPago in storage.
     *
     * @param CreateModoPagoRequest $request
     *
     * @return Response
     */
    public function store(CreateModoPagoRequest $request)
    {
        $input = $request->all();

        $modoPago = $this->modoPagoRepository->create($input);

        Flash::success('Modo Pago saved successfully.');

        return redirect(route('modoPagos.index'));
    }

    /**
     * Display the specified ModoPago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modoPago = $this->modoPagoRepository->find($id);

        if (empty($modoPago)) {
            Flash::error('Modo Pago not found');

            return redirect(route('modoPagos.index'));
        }

        return view('modo_pagos.show')->with('modoPago', $modoPago);
    }

    /**
     * Show the form for editing the specified ModoPago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modoPago = $this->modoPagoRepository->find($id);

        if (empty($modoPago)) {
            Flash::error('Modo Pago not found');

            return redirect(route('modoPagos.index'));
        }

        return view('modo_pagos.edit')->with('modoPago', $modoPago);
    }

    /**
     * Update the specified ModoPago in storage.
     *
     * @param  int              $id
     * @param UpdateModoPagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModoPagoRequest $request)
    {
        $modoPago = $this->modoPagoRepository->find($id);

        if (empty($modoPago)) {
            Flash::error('Modo Pago not found');

            return redirect(route('modoPagos.index'));
        }

        $modoPago = $this->modoPagoRepository->update($request->all(), $id);

        Flash::success('Modo Pago updated successfully.');

        return redirect(route('modoPagos.index'));
    }

    /**
     * Remove the specified ModoPago from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modoPago = $this->modoPagoRepository->find($id);

        if (empty($modoPago)) {
            Flash::error('Modo Pago not found');

            return redirect(route('modoPagos.index'));
        }

        $this->modoPagoRepository->delete($id);

        Flash::success('Modo Pago deleted successfully.');

        return redirect(route('modoPagos.index'));
    }
}
