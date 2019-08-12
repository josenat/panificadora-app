<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('cuentaClientes.index'));
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('clientes', 'ClienteController');

Route::resource('deudas', 'DeudaController');

Route::resource('facturas', 'FacturaController');

Route::resource('pagos', 'PagoController');

Route::resource('modoPagos', 'ModoPagoController');

Route::resource('facturaProductos', 'FacturaProductoController');

Route::resource('productos', 'ProductoController');

Route::resource('categorias', 'CategoriaController');

Route::resource('cuentaClientes', 'CuentaClienteController');

Route::resource('estados', 'EstadoController');

Route::resource('estadoClientes', 'EstadoClienteController');

Route::post('calcular-importe', 'CuentaClienteController@calcularImporte');