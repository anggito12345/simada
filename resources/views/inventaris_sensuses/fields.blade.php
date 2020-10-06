<!-- Idinventaris Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idinventaris', 'Idinventaris:') !!}
    {!! Form::number('idinventaris', null, ['class' => 'form-control']) !!}
</div>

<!-- No Sk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_sk', 'No Sk:') !!}
    {!! Form::text('no_sk', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Sk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_sk', 'Tanggal Sk:') !!}
    {!! Form::text('tanggal_sk', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('inventarisSensuses.index') }}" class="btn btn-default">Cancel</a>
</div>
