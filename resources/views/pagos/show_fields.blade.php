<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $pago->id !!}</p>
</div>

<!-- Factura Id Field -->
<div class="form-group">
    {!! Form::label('factura_id', 'Factura Id:') !!}
    <p>{!! $pago->factura_id !!}</p>
</div>

<!-- Modo Pago Id Field -->
<div class="form-group">
    {!! Form::label('modo_pago_id', 'Modo Pago Id:') !!}
    <p>{!! $pago->modo_pago_id !!}</p>
</div>

<!-- Monto Field -->
<div class="form-group">
    {!! Form::label('monto', 'Monto:') !!}
    <p>{!! $pago->monto !!}</p>
</div>

<!-- Observacion Field -->
<div class="form-group">
    {!! Form::label('observacion', 'Observacion:') !!}
    <p>{!! $pago->observacion !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $pago->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $pago->updated_at !!}</p>
</div>

