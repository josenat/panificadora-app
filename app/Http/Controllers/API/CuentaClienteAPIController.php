<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCuentaClienteAPIRequest;
use App\Http\Requests\API\UpdateCuentaClienteAPIRequest;
use App\Models\CuentaCliente;
use App\Repositories\CuentaClienteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CuentaClienteController
 * @package App\Http\Controllers\API
 */

class CuentaClienteAPIController extends AppBaseController
{
    /** @var  CuentaClienteRepository */
    private $cuentaClienteRepository;

    public function __construct(CuentaClienteRepository $cuentaClienteRepo)
    {
        $this->cuentaClienteRepository = $cuentaClienteRepo;
    }

    /**
     * Display a listing of the CuentaCliente.
     * GET|HEAD /cuentaClientes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cuentaClientes = $this->cuentaClienteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cuentaClientes->toArray(), 'Cuenta Clientes retrieved successfully');
    }

    /**
     * Store a newly created CuentaCliente in storage.
     * POST /cuentaClientes
     *
     * @param CreateCuentaClienteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCuentaClienteAPIRequest $request)
    {
        $input = $request->all();

        $cuentaCliente = $this->cuentaClienteRepository->create($input);

        return $this->sendResponse($cuentaCliente->toArray(), 'Cuenta Cliente saved successfully');
    }

    /**
     * Display the specified CuentaCliente.
     * GET|HEAD /cuentaClientes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CuentaCliente $cuentaCliente */
        $cuentaCliente = $this->cuentaClienteRepository->find($id);

        if (empty($cuentaCliente)) {
            return $this->sendError('Cuenta Cliente not found');
        }

        return $this->sendResponse($cuentaCliente->toArray(), 'Cuenta Cliente retrieved successfully');
    }

    /**
     * Update the specified CuentaCliente in storage.
     * PUT/PATCH /cuentaClientes/{id}
     *
     * @param int $id
     * @param UpdateCuentaClienteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCuentaClienteAPIRequest $request)
    {
        $input = $request->all();

        /** @var CuentaCliente $cuentaCliente */
        $cuentaCliente = $this->cuentaClienteRepository->find($id);

        if (empty($cuentaCliente)) {
            return $this->sendError('Cuenta Cliente not found');
        }

        $cuentaCliente = $this->cuentaClienteRepository->update($input, $id);

        return $this->sendResponse($cuentaCliente->toArray(), 'CuentaCliente updated successfully');
    }

    /**
     * Remove the specified CuentaCliente from storage.
     * DELETE /cuentaClientes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CuentaCliente $cuentaCliente */
        $cuentaCliente = $this->cuentaClienteRepository->find($id);

        if (empty($cuentaCliente)) {
            return $this->sendError('Cuenta Cliente not found');
        }

        $cuentaCliente->delete();

        return $this->sendResponse($id, 'Cuenta Cliente deleted successfully');
    }
}
