<!-- Kode Rek Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_akun', 'Kode Akun:') !!}
    {!! Form::text('kode_akun', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Akun Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_akun', 'Kode Akun') !!}
    {!! Form::text('kode_akun', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Kelompok Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_kelompok', 'Kode Kelompok') !!}
    {!! Form::text('kode_kelompok', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Objek Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_objek', 'Kode Objek') !!}
    {!! Form::text('kode_objek', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Rincian Objek Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_rincian_objek', 'Kode Rincian Objek') !!}
    {!! Form::text('kode_rincian_objek', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Sub Rincian Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_sub_rincian_objek', 'Kode Sub Rincian Objek') !!}
    {!! Form::text('kode_sub_rincian_objek', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Sub Sub Rincian Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_sub_sub_rincian_objek', 'Kode Sub Rincian Objek') !!}
    {!! Form::text('kode_sub_sub_rincian_objek', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Rek Aset Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('nama_rek_aset', __('field.nama_rek_aset')) !!}
    {!! Form::text('nama_rek_aset', null, ['class' => 'form-control']) !!}
</div>

<!-- Umur Ekononomis Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('umur_ekononomis', 'Umur Ekononomis:') !!}
    {!! Form::number('umur_ekononomis', null, ['class' => 'form-control']) !!}
</div>

@if(strpos($idPostfix, 'non-ajax') > -1)
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('barangs.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif

@section(strpos($idPostfix, 'non-ajax') > -1 ? 'scripts' : 'scripts_2')
    <script type="text/javascript">        
        
    </script>
    @if (isset($barang))
    <script>
        
    </script>
    @endif
@endsection