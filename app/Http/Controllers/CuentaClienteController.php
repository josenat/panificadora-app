<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\CuentaClienteDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCuentaClienteRequest;
use App\Http\Requests\UpdateCuentaClienteRequest;
use App\Repositories\CuentaClienteRepository;

use App\Models\Cliente;
use App\DataTables\ClienteDataTable;
use App\Http\Requests\CreateClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\ClienteRepository;

use App\Models\Factura;
use App\DataTables\FacturaDataTable;
use App\Http\Requests\CreateFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Repositories\FacturaRepository;

use App\Models\FacturaProducto;
use App\DataTables\FacturaProductoDataTable;
use App\Http\Requests\CreateFacturaProductoRequest;
use App\Http\Requests\UpdateFacturaProductoRequest;
use App\Repositories\FacturaProductoRepository;

use App\Models\Producto;
use App\DataTables\ProductoDataTable;
use App\Http\Requests\CreateProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Repositories\ProductoRepository;

use App\Models\Deuda;
use App\DataTables\DeudaDataTable;
use App\Http\Requests\CreateDeudaRequest;
use App\Http\Requests\UpdateDeudaRequest;
use App\Repositories\DeudaRepository;

use App\Models\Pago;
use App\Models\ModoPago;
use App\DataTables\PagoDataTable;
use App\Http\Requests\CreatePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Repositories\PagoRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CuentaClienteController extends AppBaseController
{
    /** @var  CuentaClienteRepository */
    private $cuentaClienteRepository;

    public function __construct(CuentaClienteRepository $cuentaClienteRepo,
        ClienteRepository $clienteRepo,
        FacturaRepository $facturaRepo,
        FacturaProductoRepository $facturaProductoRepo,
        ProductoRepository $productoRepo,
        DeudaRepository $monto_deudaRepo,
        PagoRepository $pagoRepo
    )
    {
        $this->cuentaClienteRepository = $cuentaClienteRepo;
        $this->clienteRepository = $clienteRepo;
        $this->facturaRepository = $facturaRepo;
        $this->facturaProductoRepository = $facturaProductoRepo;
        $this->productoRepository = $productoRepo;
        $this->deudaRepository = $monto_deudaRepo;
        $this->pagoRepository = $pagoRepo;
    }

    /**
     * Display a listing of the CuentaCliente.
     *
     * @param CuentaClienteDataTable $cuentaClienteDataTable
     * @return Response
     */
    public function index(CuentaClienteDataTable $cuentaClienteDataTable)
    {   
        return $cuentaClienteDataTable->render('cuenta_clientes.index');
    }

    /**
     * Show the form for creating a new CuentaCliente.
     *
     * @return Response
     */
    public function create()
    {    
        $clientes_all = Cliente::where('deleted_at',null)->get(['id','dni','nombre','apellido']);
        foreach ($clientes_all as &$key) {
            $key->descripcion = $key->dni .' | '. $key->nombre .' '. $key->apellido;
        } 
        $clientes = $clientes_all->pluck('descripcion', 'id');

        $productos = Producto::where('deleted_at',null)->pluck('nombre', 'id');

        $modos = ModoPago::where('deleted_at',null)->pluck('nombre', 'id');

        return view('cuenta_clientes.create', compact('clientes','productos','modos'));
    }

    /**
     * Store a newly created CuentaCliente in storage.
     *
     * @param CreateCuentaClienteRequest $request
     *
     * @return Response
     */
    public function store(CreateCuentaClienteRequest $request)
    { 
        // obtener fecha
        $fecha    = $request{'fecha'};
        // obtener modo de pago
        $modo_id  = $request{'modo_id'};
        // obtener importe 
        $importe  = $request{'importe'};
        // obtener observacion de pago
        $observacion = $request{'observacion'};
        // obtener cantidad
        $cantidad = $request{'cantidad'};
        // obtener cliente
        $cliente  = Cliente::where('deleted_at',null)->find($request{'cliente_id'});
        //obtener productos
        $producto = Producto::where('deleted_at',null)->find($request{'producto_id'});
        // obtener costo factura
        $costo = $cantidad * $producto->precio;
        // crear factura
        if ($factura_id = Factura::where('deleted_at',null)->create([
            'fecha' => $fecha,
            'cliente_id' => $cliente->id
        ])->id) {
            // obtener factura creada
            $factura = Factura::where('deleted_at',null)->find($factura_id);
            // crear detalle factura
            if ($detalle_id = FacturaProducto::where('deleted_at',null)->create([
                'factura_id' => $factura_id,
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'precio' => $producto->precio
            ])->id) {
                // si no existe importe dado
                if (empty($importe)) {

                    // guardamos la deuda en factura
                    $factura->deuda = $costo;
                    $factura->save();

                    // guardamos una deuda para el cliente
                    if ($this->gestionarDeuda($cliente->dni, $fecha, $costo, 'sumar')) {

                        Flash::success('Factura creada exitosamente.');
                    } else {
                        // eliminar los siguientes registros
                        FacturaProducto::destroy($detalle_id);
                        Factura::destroy($factura_id);

                        Flash::error('Error de operación.');
                    }

                // sino que sí existe importe
                } else {
                    // si el importe es menor al costo de la factura
                    if ($importe < $costo) {
                        // obtenemos diferencia
                        $diferencia = $costo - $importe;
                        // guardamos la diferencia en factura
                        $factura->deuda = $diferencia;
                        $factura->save();

                        // guardamos una deuda para el cliente
                        if (!$this->gestionarDeuda($cliente->dni, $fecha, $diferencia, 'sumar')) { 
                            // si no se guardo la deuda eliminamos los siguientes registros
                            FacturaProducto::destroy($detalle_id);
                            Factura::destroy($factura_id);

                            Flash::error('Error de operación.');
                        }
                    // sino que si el importe es mayor al costo de la factura
                    } elseif ($importe > $costo) {
                        // obtenemos diferencia
                        $diferencia = $importe - $costo;
                        // restamos la diferencia a la deuda del cliente
                        if (!$this->gestionarDeuda($cliente->dni, $fecha, $diferencia, 'restar')) {
                            // si no se guardo la deuda eliminamos los siguientes registros
                            FacturaProducto::destroy($detalle_id);
                            Factura::destroy($factura_id);

                            Flash::error('Error de operación.');
                        }
                    } 

                    // crear pago de cliente
                    if (Pago::create([
                        'factura_id' => $factura_id,
                        'modo_pago_id' => $modo_id,
                        'monto' => $importe,
                        'observacion' => $observacion
                    ])) {
                        Flash::success('Factura creada exitosamente.');
                    // si no se registro el pago
                    } else {
                        // eliminar registros
                        FacturaProducto::destroy($detalle_id);
                        Factura::destroy($factura_id);
                        Flash::error('Error de operación.');
                    }
                }
            } else {
                Flash::error('Error de operación.');
            }
        } else {
            Flash::error('Error de operación.');
        }

        return redirect(route('cuentaClientes.index'));
    }

    /**
     * Display the specified CuentaCliente.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cuentaCliente = $this->cuentaClienteRepository->find($id);

        if (empty($cuentaCliente)) {
            Flash::error('Factura no encontrada.');

            return redirect(route('cuentaClientes.index'));
        }

        return view('cuenta_clientes.show')->with('cuentaCliente', $cuentaCliente);
    }

    /**
     * Show the form for editing the specified CuentaCliente.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {   
        // obtener factura
        $factura = Factura::where('deleted_at',null)->find($id); 
        // validar registro
        if (empty($factura)) {
            Flash::error('Factura no encontrada.');

            return redirect(route('cuentaClientes.index'));
        }
        // obtener cliente seleccionado
        $cliente = Cliente::where('deleted_at',null)->where('id',$factura->cliente_id)->first(['id','dni','nombre','apellido']);
        $cliente->descripcion = $cliente->dni .' | '. $cliente->nombre .' '. $cliente->apellido;
        // obtener lista de clientes con el siguiente formato
        $clientes_all = Cliente::where('deleted_at',null)->get(['id','dni','nombre','apellido']);
        foreach ($clientes_all as &$key) {
            $key->descripcion = $key->dni .' | '. $key->nombre .' '. $key->apellido;
        } 
        // definir select con el formato obtenido
        $clientes = $clientes_all->pluck('descripcion', 'id');
        // colocar de primero al cliente seleccionado 
        $clientes->prepend($cliente->descripcion, $cliente->id);

        // obtener el primer detalle factura para conocer el producto seleccionado
        $facturaProducto = FacturaProducto::where('deleted_at',null)->where('factura_id',$factura->id)->first(['id','producto_id']); 
        $producto  = Producto::where('deleted_at',null)->where('id',$facturaProducto->producto_id)->first(['id','nombre']);  
        // definir select
        $productos = Producto::where('deleted_at',null)->pluck('nombre', 'id');
        // colocar de primero al producto seleccionado 
        $productos->prepend($producto->nombre, $producto->id);

        $fecha    = $factura->fecha;
        $cantidad = $facturaProducto->cantidad;

        // definir select 
        $modos   = ModoPago::where('deleted_at',null)->pluck('nombre', 'id');

        // obtener importe si existe
        if ($pago = Pago::where('deleted_at',null)->where('factura_id',$factura->id)->first()) { 
            // obtener monto de importe
            $importe     = $pago->monto;
            // obtener observacion
            $observacion = $pago->observacion; 
            // obtener modo de pago
            $modo        = ModoPago::where('deleted_at',null)->where('id',$pago->modo_pago_id)->first();
            // colocar de primero al modo seleccionado
            $modos->prepend($modo->nombre, $modo->id);
        } else {
            $importe     = 0;
            $observacion = '';
            $modos->prepend('NINGUNO', 0);  
        }

        // objeto auxiliar
        $cuentaCliente = $this->cuentaClienteRepository->find($id);

        return view('cuenta_clientes.edit', compact('cuentaCliente','clientes','productos','modos','fecha','cantidad','importe','observacion'));
    }

    /**
     * Update the specified CuentaCliente in storage.
     *
     * @param  int              $id
     * @param UpdateCuentaClienteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCuentaClienteRequest $request)
    {
        // obtener factura
        $factura = Factura::where('deleted_at',null)->find($id); 
        // validar registro
        if (empty($factura)) {
            Flash::error('Factura no encontrada.');

            return redirect(route('cuentaClientes.index'));
        }
        // obtener importe si existe
        if ($pago = Pago::where('deleted_at',null)->where('factura_id',$factura->id)->first()) { 
            // actualizar observacion
            $pago->observacion = $request{'observacion'}; 
            // guardar cambios
            $pago->save();

            Flash::success('Factura actualizada exitosamente.');
        } else {
            Flash::warning('Factura sin cambios.');
        }

        return redirect(route('cuentaClientes.index'));
    }

    /**
     * Remove the specified CuentaCliente from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $factura = $this->facturaRepository->find($id);

        if (empty($factura)) {
            Flash::error('Factura no encontrada.');

            return redirect(route('cuentaClientes.index'));
        }

        $cliente = Cliente::where('deleted_at',null)->where('id',$factura->cliente_id)->first(['dni']);        

        $facturaProducto = FacturaProducto::where('deleted_at',null)->where('factura_id',$factura->id)->first(); 

        // eliminar detalle factura 
        if ($facturaProducto->delete($facturaProducto->id)) {
            // eliminar factura
            if ($factura->delete($factura->id)) {
                // si existe pago de la factura eliminada
                if ($pago = Pago::where('deleted_at',null)->where('factura_id',$factura->id)->first()) {
                    // obtener monto de pago  
                    $monto = $pago->monto;
                    // eliminar pago
                    if ($pago->delete($pago->id)) {
                        // validamos si ya tiene deuda registrada el cliente
                        if ($deuda = Deuda::where('deleted_at',null)->where('cliente_dni', $cliente->dni)->first()) {
                            // si tiene entonces sumamos el pago elimnado a la deuda
                            $deuda->monto = $deuda->monto + $monto;
                            $deuda->save();
                        } else {
                            // crear deuda 
                            Deuda::create([
                                'fecha' => $fecha,
                                'monto' => $monto,
                                'cliente_dni' => $cliente->dni,
                                'estado_id' => 4 // vigente
                            ]);
                        } 

                        Flash::success('Factura eliminada exitosamente.');
                    } else {
                        Flash::error('Error de operacion.');
                    }
                }  else {
                    Flash::error('Error de operacion.');
                }              
            } else {
                Flash::error('Error de operacion.');
            }           
        } else {
            Flash::error('Error de operacion.');
        }   

        return redirect(route('cuentaClientes.index'));
    }

    /*
    * Registrar deudas al cliente
    */
    public function gestionarDeuda($dni, $fecha, $monto, $accion)
    {
        if ($accion == 'sumar') {
            // validamos si ya tiene deuda registrada el cliente
            if ($deuda = Deuda::where('deleted_at',null)->where('cliente_dni', $dni)->first()) {
                // entonces sumamos las deudas
                $deuda->monto = $deuda->monto + $monto;
                $deuda->fecha = $fecha;
                $deuda->save();
            } else { 
                // crear deuda
                if (!Deuda::create([
                    'fecha'       => $fecha,
                    'monto'       => $monto,
                    'cliente_dni' => $dni,
                    'estado_id'   => 4 // vigente
                ])) {
                    // si no se registro la deuda
                    return false;
                }                       
            }

        } elseif ($accion == 'restar') {
            // obtener deuda del cliente
            if ($deuda = Deuda::where('deleted_at',null)->where('cliente_dni', $dni)->first()) {
                // si la deuda actual es mayor que el monto a restar
                if ($deuda->monto > $monto) {
                     // restamos el monto 
                    $deuda->monto = $deuda->monto - $monto;  
                    $deuda->fecha = $fecha;
                    $deuda->save();  
                // sino entonces eliminamos la deuda automaticamente               
                } else {
                    Deuda::destroy($deuda->id);
                }
            } else {

                return false;
            }
        }

        return true;
    }

    /*
    * Calcular importe de pago de factura
    */
    public function calcularImporte(Request $request)
    {
        $producto = Producto::where('deleted_at',null)->find($request{'producto_id'});
        $importe  = $producto->precio * $request{'cantidad'};

        return $importe; 
    }
}
