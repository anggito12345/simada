<!-- Pid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pid', 'Pid:') !!}
    {!! Form::number('pid', null, ['class' => 'form-control']) !!}
</div>

<!-- Inventaris Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inventaris', 'Inventaris:') !!}
    {!! Form::number('inventaris', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mutasiDetils.index') !!}" class="btn btn-default">Cancel</a>
</div>
