@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('cuentaClientes.index') !!}">Facturas</a>
          </li>
          <li class="breadcrumb-item active">Editar</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Editar Factura</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($cuentaCliente, ['route' => ['cuentaClientes.update', $cuentaCliente->id], 'method' => 'patch']) !!}

                                <!-- Fecha Field -->
                                <div class="form-group col-sm-6">
                                    {!! Form::label('fecha', 'Fecha:') !!}
                                    {!! Form::text('fecha', $fecha, ['class' => 'form-control','id'=>'fecha', 'disabled']) !!}
                                </div>

                                <!-- Cliente Field -->
                                <div class="form-group col-sm-6">
                                    {!! Form::label('cliente', 'Cliente:') !!}
                                    {!! Form::select('cliente_id', $clientes, null, ['class' => 'form-control', 'disabled']) !!}
                                </div>

                                <!-- Producto Field -->
                                <div class="form-group col-sm-6">
                                    {!! Form::label('producto', 'Producto:') !!}
                                    {!! Form::select('producto_id', $productos, null, ['class' => 'form-control producto_id', 'disabled']) !!}
                                </div>

                                <!-- Cantidad Field -->
                                <div class="form-group col-sm-6">
                                    {!! Form::label('cantidad', 'Cantidad:') !!}
                                    {!! Form::number('cantidad', $cantidad, ['class' => 'form-control cantidad', 'disabled', 'min'=>'0']) !!}
                                </div>

                                <!-- Importe Field -->
                                <div class="form-group col-sm-6">
                                  <div class="form-row">
                                    <div class="form-group col-md-10">
                                      {!! Form::label('importe', 'Importe:') !!}
                                      {!! Form::number('importe', $importe, ['class' => 'form-control importe', 'disabled', 'step'=>'0.01', 'min'=>'0']) !!}
                                    </div>
                                    <div class="form-group col-md-2">
                                      <a class="btn btn-default btn-calcular" style="margin-top: 28px" disabled>Calcular</a>
                                    </div>
                                  </div>
                                  <input name="_token" class="csrf-token"  type="hidden" value="{{ Session::token() }}"/>
                                </div>

                                <!-- Modo Field -->
                                <div class="form-group col-sm-6">
                                    {!! Form::label('modo', 'Modo de Pago:') !!}
                                    {!! Form::select('modo_id', $modos, null, ['class' => 'form-control', 'disabled']) !!}
                                </div>                                
                                
                                <!-- Observacion Field -->
                                @if ($importe > 0)
                                <div class="form-group col-sm-6" style="margin-top: -12px">
                                    {!! Form::label('observacion', 'Observacion de Pago:') !!}
                                    {!! Form::text('observacion', $observacion, ['class' => 'form-control']) !!}
                                </div>
                                @endif


                                <!-- Submit Field -->
                                <div class="form-group col-sm-12">
                                    @if ($importe > 0)
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                    @endif
                                    <a href="{!! route('cuentaClientes.index') !!}" class="btn btn-default">Atrás</a>
                                </div>


                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection


@section('scripts')
   <script type="text/javascript">
      $(document).ready(function() {

           $('#fecha').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           });


            now = new Date();
            year = "" + now.getFullYear();
            month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
            day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
            hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
            minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
            second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
           $('#fecha').val(year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second);     


          $('.btn-calcular').click(function() { 
              var token = $(".csrf-token").val(); 
              var data  = {
                  "producto_id" : $('.producto_id').val(),
                  "cantidad"    : $('.cantidad').val()
              };
              $.ajax({
                url:      "/calcular-importe",
                headers:  {"X-CSRF-TOKEN":token},
                type:     "POST",
                dataType: "JSON",
                data:     data              
              
              }).done(function(res) { 
                  $('.importe').val(res);   
                  
              }).fail(function(res) {
                  //
              });             
          });
  
      });  
       </script>
@endsection