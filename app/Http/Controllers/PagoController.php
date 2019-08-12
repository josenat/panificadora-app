<?php

namespace App\Http\Controllers;

use App\DataTables\PagoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Repositories\PagoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PagoController extends AppBaseController
{
    /** @var  PagoRepository */
    private $pagoRepository;

    public function __construct(PagoRepository $pagoRepo)
    {
        $this->pagoRepository = $pagoRepo;
    }

    /**
     * Display a listing of the Pago.
     *
     * @param PagoDataTable $pagoDataTable
     * @return Response
     */
    public function index(PagoDataTable $pagoDataTable)
    {
        return $pagoDataTable->render('pagos.index');
    }

    /**
     * Show the form for creating a new Pago.
     *
     * @return Response
     */
    public function create()
    {
        return view('pagos.create');
    }

    /**
     * Store a newly created Pago in storage.
     *
     * @param CreatePagoRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRequest $request)
    {
        $input = $request->all();

        $pago = $this->pagoRepository->create($input);

        Flash::success('Pago saved successfully.');

        return redirect(route('pagos.index'));
    }

    /**
     * Display the specified Pago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pago = $this->pagoRepository->find($id);

        if (empty($pago)) {
            Flash::error('Pago not found');

            return redirect(route('pagos.index'));
        }

        return view('pagos.show')->with('pago', $pago);
    }

    /**
     * Show the form for editing the specified Pago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pago = $this->pagoRepository->find($id);

        if (empty($pago)) {
            Flash::error('Pago not found');

            return redirect(route('pagos.index'));
        }

        return view('pagos.edit')->with('pago', $pago);
    }

    /**
     * Update the specified Pago in storage.
     *
     * @param  int              $id
     * @param UpdatePagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRequest $request)
    {
        $pago = $this->pagoRepository->find($id);

        if (empty($pago)) {
            Flash::error('Pago not found');

            return redirect(route('pagos.index'));
        }

        $pago = $this->pagoRepository->update($request->all(), $id);

        Flash::success('Pago updated successfully.');

        return redirect(route('pagos.index'));
    }

    /**
     * Remove the specified Pago from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pago = $this->pagoRepository->find($id);

        if (empty($pago)) {
            Flash::error('Pago not found');

            return redirect(route('pagos.index'));
        }

        $this->pagoRepository->delete($id);

        Flash::success('Pago deleted successfully.');

        return redirect(route('pagos.index'));
    }
}
