<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Pid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pid', 'Pid:') !!}
    {!! Form::number('pid', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('moduleAccesses.index') !!}" class="btn btn-default">Batal</a>
</div>
