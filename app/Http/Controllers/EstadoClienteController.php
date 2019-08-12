<?php

namespace App\Http\Controllers;

use App\DataTables\EstadoClienteDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateEstadoClienteRequest;
use App\Http\Requests\UpdateEstadoClienteRequest;
use App\Repositories\EstadoClienteRepository;

use App\DataTables\ClienteDataTable;
use App\Http\Requests\CreateClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\ClienteRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class EstadoClienteController extends AppBaseController
{ 
    private $estadoClienteRepository;
    private $clienteRepository;

    public function __construct(EstadoClienteRepository $estadoClienteRepo, ClienteRepository $clienteRepo)
    {
        $this->estadoClienteRepository = $estadoClienteRepo;
        $this->clienteRepository = $clienteRepo;
    }


    public function index(EstadoClienteDataTable $estadoClienteDataTable)
    {
        return $estadoClienteDataTable->render('estado_clientes.index');
    }

    /** 
     * Show the form for creating a new Cliente.
     *
     * @return Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created Cliente in storage.
     *
     * @param CreateClienteRequest $request
     *
     * @return Response
     */
    public function store(CreateClienteRequest $request)
    {
        $input = $request->all();

        $cliente = $this->clienteRepository->create($input);

        Flash::success('Cliente registrado exitosamente.');

        return redirect(route('estado_clientes.index'));
    }

    /**
     * Display the specified Cliente.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error('Cliente no encontrado.');

            return redirect(route('clientes.index'));
        }

        return view('clientes.show')->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified Cliente.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error('Cliente no encontrado.');

            return redirect(route('clientes.index'));
        }

        return view('clientes.edit')->with('cliente', $cliente);
    }

    /**
     * Update the specified Cliente in storage.
     *
     * @param  int              $id
     * @param UpdateClienteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClienteRequest $request)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error('Cliente no encontrado');

            return redirect(route('clientes.index'));
        }

        $cliente = $this->clienteRepository->update($request->all(), $id);

        Flash::success('Cliente actualizado exitosamente.');

        return redirect(route('estado_clientes.index'));
    }

    /**
     * Remove the specified Cliente from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error('Cliente no encontrado');

            return redirect(route('clientes.index'));
        }

        $this->clienteRepository->delete($id);

        Flash::success('Cliente eliminado exitosamente.');

        return redirect(route('estado_clientes.index'));
    }



    /*

    public function create()
    {
        return view('estado_clientes.create');
    }


    public function store(CreateEstadoClienteRequest $request)
    {
        $input = $request->all();

        $estadoCliente = $this->estadoClienteRepository->create($input);

        Flash::success('Estado Cliente saved successfully.');

        return redirect(route('estadoClientes.index'));
    }

 
    public function show($id)
    {
        $estadoCliente = $this->estadoClienteRepository->find($id);

        if (empty($estadoCliente)) {
            Flash::error('Estado Cliente not found');

            return redirect(route('estadoClientes.index'));
        }

        return view('estado_clientes.show')->with('estadoCliente', $estadoCliente);
    }


    public function edit($id)
    {
        $estadoCliente = $this->estadoClienteRepository->find($id);

        if (empty($estadoCliente)) {
            Flash::error('Estado Cliente not found');

            return redirect(route('estadoClientes.index'));
        }

        return view('estado_clientes.edit')->with('estadoCliente', $estadoCliente);
    }

 
    public function update($id, UpdateEstadoClienteRequest $request)
    {
        $estadoCliente = $this->estadoClienteRepository->find($id);

        if (empty($estadoCliente)) {
            Flash::error('Estado Cliente not found');

            return redirect(route('estadoClientes.index'));
        }

        $estadoCliente = $this->estadoClienteRepository->update($request->all(), $id);

        Flash::success('Estado Cliente updated successfully.');

        return redirect(route('estadoClientes.index'));
    }

 
    public function destroy($id)
    {
        $estadoCliente = $this->estadoClienteRepository->find($id);

        if (empty($estadoCliente)) {
            Flash::error('Estado Cliente not found');

            return redirect(route('estadoClientes.index'));
        }

        $this->estadoClienteRepository->delete($id);

        Flash::success('Estado Cliente deleted successfully.');

        return redirect(route('estadoClientes.index'));
    }

    */
}
