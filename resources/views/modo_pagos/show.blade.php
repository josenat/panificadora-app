@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('pagos.index') !!}">Pagos</a>
      </li>
            <li class="breadcrumb-item">
                <a href="{!! route('modoPagos.index') !!}">Modos de Pagos</a>
            </li>
            <li class="breadcrumb-item active">Detalle</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Detalles</strong>
                                  <a href="{!! route('modoPagos.index') !!}" class="btn btn-default">Atrás</a>
                             </div>
                             <div class="card-body">
                                 @include('modo_pagos.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
