<!-- Nama Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Aktif Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('aktif', 'Aktif:') !!} &nbsp;
    <div class="radio">
        {!! Form::radio('aktif', 1, isset($perolehan) ? $perolehan->aktif == 1 : false) !!} Ya
        {!! Form::radio('aktif', 0, isset($perolehan) ? $perolehan->aktif == 0 : false) !!} Tidak
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('perolehans.index') !!}" class="btn btn-default">Batal</a>
</div>
