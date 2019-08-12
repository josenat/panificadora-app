@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('cuentaClientes.index') !!}">Facturas</a>
      </li>
      <li class="breadcrumb-item active">Crear</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Crear Factura</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'cuentaClientes.store']) !!}

                                  <!-- Fecha Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('fecha', 'Fecha:') !!}
                                      {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
                                  </div>

                                  <!-- Cliente Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('cliente', 'Cliente:') !!}
                                      {!! Form::select('cliente_id', $clientes, null, ['class' => 'form-control', 'placeholder'=>'SELECCIONE', 'required']) !!}
                                  </div>

                                  <!-- Producto Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('producto', 'Producto:') !!}
                                      {!! Form::select('producto_id', $productos, null, ['class' => 'form-control producto_id', 'required']) !!}
                                  </div>

                                  <!-- Cantidad Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('cantidad', 'Cantidad:') !!}
                                      {!! Form::number('cantidad', null, ['class' => 'form-control cantidad', 'required', 'min'=>'0']) !!}
                                  </div>

                                  <!-- Importe Field -->
                                  <div class="form-group col-sm-6">
                                    <div class="form-row">
                                      <div class="form-group col-md-10">
                                        {!! Form::label('importe', 'Importe:') !!}
                                        {!! Form::number('importe', null, ['class' => 'form-control importe', 'step'=>'0.01', 'min'=>'0']) !!}
                                      </div>
                                      <div class="form-group col-md-2">
                                        <a class="btn btn-default btn-calcular" style="margin-top: 28px">Calcular</a>
                                      </div>
                                    </div>
                                    <input name="_token" class="csrf-token"  type="hidden" value="{{ Session::token() }}"/> 
                                  </div>

                                  <!-- Modo Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('modo', 'Modo de Pago:') !!}
                                      {!! Form::select('modo_id', $modos, null, ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Observacion Field -->
                                  <div class="form-group col-sm-6" style="margin-top: -12px">
                                      {!! Form::label('observacion', 'Observacion de Pago:') !!}
                                      {!! Form::text('observacion', null, ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Submit Field -->
                                  <div class="form-group col-sm-12">
                                      {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                      <a href="{!! route('cuentaClientes.index') !!}" class="btn btn-default">Cancelar</a>
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