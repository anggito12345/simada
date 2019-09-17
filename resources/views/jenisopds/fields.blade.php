<!-- Nama Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Aktif Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('aktif', 'Aktif:') !!}
    <div class="radio">
        {!! Form::radio('aktif', 1, isset($jenisopd) ? $jenisopd->aktif == 1 : false) !!} Ya
        {!! Form::radio('aktif', 0, isset($jenisopd) ? $jenisopd->aktif == 0 : false) !!} Tidak
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('jenisopds.index') !!}" class="btn btn-default">Cancel</a>
</div>
