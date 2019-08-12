<!-- Factura Id Field 
<div class="form-group col-sm-6">
    {!! Form::label('factura_id', 'Factura Id:') !!}
    {!! Form::text('factura_id', null, ['class' => 'form-control']) !!}
</div>
-->
<!-- Modo Pago Id Field 
<div class="form-group col-sm-6">
    {!! Form::label('modo_pago_id', 'Modo Pago Id:') !!}
    {!! Form::text('modo_pago_id', null, ['class' => 'form-control']) !!}
</div>
-->
<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control']) !!}
</div>

<!-- Observacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observacion', 'Observacion:') !!}
    {!! Form::text('observacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pagos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
