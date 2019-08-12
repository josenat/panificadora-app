@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('pagos.index') !!}">Pagos</a>
      </li>
        <li class="breadcrumb-item">Modos de Pagos</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Modos de Pagos
                             <a class="pull-right btn btn-default" href="{!! route('pagos.index') !!}"><i class="fa fa-align-justify"></i> Pagos </a>
                         </div>
                         <div class="card-body">
                             @include('modo_pagos.table')
                              <div class="pull-right mr-3">
                                     
                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

