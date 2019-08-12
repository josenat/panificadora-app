<li class="text-center" style="margin: 10px;"> Menú  </li>
<li class="nav-item {{ Request::is('cuentaClientes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('cuentaClientes.index') !!}"><i class="nav-icon icon-cursor"></i><span>Facturas</span></a>
</li>
<li class="nav-item {{ Request::is('estadoClientes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('estadoClientes.index') !!}"><i class="nav-icon icon-cursor"></i><span>Clientes</span></a>
</li>
<li class="nav-item {{ Request::is('deudas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('deudas.index') !!}"><i class="nav-icon icon-cursor"></i><span>Deudas</span></a>
</li>
<li class="nav-item {{ Request::is('pagos*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('pagos.index') !!}"><i class="nav-icon icon-cursor"></i><span>Pagos</span></a>
</li>
<li class="nav-item {{ Request::is('productos*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('productos.index') !!}"><i class="nav-icon icon-cursor"></i><span>Productos</span></a>
</li>