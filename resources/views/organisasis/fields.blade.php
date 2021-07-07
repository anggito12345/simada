<!-- Kode Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('kode', 'Kode:') !!}
    {!! Form::text('kode', null, ['class' => 'form-control']) !!}
</div>

<!-- Pid Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pid', 'Induk Organisasi:') !!}
    {!! Form::select('pid', [],  null, ['class' => 'form-control', 'onchange' => '$("#jenis").val("").trigger("change")']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Level Organisasi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::select('level', Constant::$ROLE_LEVEL, null, ['id' => 'level', 'class' => 'form-control']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Aktif Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('aktif', 'Aktif:') !!} &nbsp;
    <div class="radio">
        {!! Form::radio('aktif', 1, isset($organisasi) ? $organisasi->aktif == 1 : false) !!} Ya
        {!! Form::radio('aktif', 0, isset($organisasi) ? $organisasi->aktif == 0 : false) !!} Tidak
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('organisasis.index') !!}" class="btn btn-default">Batal</a>
</div>


@section('scripts')
    @include('organisasis.script')
@endsection
