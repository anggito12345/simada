<!-- Idinventaris Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idinventaris', 'Idinventaris:') !!}
    {!! Form::number('idinventaris', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kondisi', 'Kondisi:') !!}
    {!! Form::text('kondisi', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('inventarisSensuses.index') }}" class="btn btn-default">Cancel</a>
</div>
