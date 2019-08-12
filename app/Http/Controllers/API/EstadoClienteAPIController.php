<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEstadoClienteAPIRequest;
use App\Http\Requests\API\UpdateEstadoClienteAPIRequest;
use App\Models\EstadoCliente;
use App\Repositories\EstadoClienteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EstadoClienteController
 * @package App\Http\Controllers\API
 */

class EstadoClienteAPIController extends AppBaseController
{
    /** @var  EstadoClienteRepository */
    private $estadoClienteRepository;

    public function __construct(EstadoClienteRepository $estadoClienteRepo)
    {
        $this->estadoClienteRepository = $estadoClienteRepo;
    }

    /**
     * Display a listing of the EstadoCliente.
     * GET|HEAD /estadoClientes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $estadoClientes = $this->estadoClienteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($estadoClientes->toArray(), 'Estado Clientes retrieved successfully');
    }

    /**
     * Store a newly created EstadoCliente in storage.
     * POST /estadoClientes
     *
     * @param CreateEstadoClienteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEstadoClienteAPIRequest $request)
    {
        $input = $request->all();

        $estadoCliente = $this->estadoClienteRepository->create($input);

        return $this->sendResponse($estadoCliente->toArray(), 'Estado Cliente saved successfully');
    }

    /**
     * Display the specified EstadoCliente.
     * GET|HEAD /estadoClientes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EstadoCliente $estadoCliente */
        $estadoCliente = $this->estadoClienteRepository->find($id);

        if (empty($estadoCliente)) {
            return $this->sendError('Estado Cliente not found');
        }

        return $this->sendResponse($estadoCliente->toArray(), 'Estado Cliente retrieved successfully');
    }

    /**
     * Update the specified EstadoCliente in storage.
     * PUT/PATCH /estadoClientes/{id}
     *
     * @param int $id
     * @param UpdateEstadoClienteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstadoClienteAPIRequest $request)
    {
        $input = $request->all();

        /** @var EstadoCliente $estadoCliente */
        $estadoCliente = $this->estadoClienteRepository->find($id);

        if (empty($estadoCliente)) {
            return $this->sendError('Estado Cliente not found');
        }

        $estadoCliente = $this->estadoClienteRepository->update($input, $id);

        return $this->sendResponse($estadoCliente->toArray(), 'EstadoCliente updated successfully');
    }

    /**
     * Remove the specified EstadoCliente from storage.
     * DELETE /estadoClientes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EstadoCliente $estadoCliente */
        $estadoCliente = $this->estadoClienteRepository->find($id);

        if (empty($estadoCliente)) {
            return $this->sendError('Estado Cliente not found');
        }

        $estadoCliente->delete();

        return $this->sendResponse($id, 'Estado Cliente deleted successfully');
    }
}
