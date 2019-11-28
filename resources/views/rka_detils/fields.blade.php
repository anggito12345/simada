<!-- Pid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pid', 'Pid:') !!}
    {!! Form::number('pid', null, ['class' => 'form-control']) !!}
</div>

<!-- No Rka Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_rka', 'No Rka:') !!}
    {!! Form::text('no_rka', null, ['class' => 'form-control']) !!}
</div>

<!-- Nilai Kontrak Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nilai_kontrak', 'Nilai Kontrak:') !!}
    {!! Form::number('nilai_kontrak', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('rkaDetils.index') !!}" class="btn btn-default">Batal</a>
</div>
