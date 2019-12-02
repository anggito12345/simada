
<u class="col-md-12">Buku Perpustakaan</u>

<div class="col-md-12">
    
    <!-- Buku Judul Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('buku_judul', 'Judul/Pencipta:') !!}
        {!! Form::text('buku_judul', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB E"]().buku_judul']) !!}
    </div>

    <!-- Buku Spesifikasi Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('buku_spesifikasi', 'Spesifikasi:') !!}
        {!! Form::text('buku_spesifikasi', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB E"]().buku_spesifikasi']) !!}
    </div>
</div>



<u class="col-md-12">Barang bercorak Kesenian/Kebudayaan</u>

<div class="col-md-12">
    
    <!-- Seni Asal Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('seni_asal', __('field.seni_asal')) !!}
        {!! Form::text('seni_asal', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB E"]().seni_asal']) !!}
    </div>

    <!-- Seni Pencipta Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('seni_pencipta', __('field.seni_pencipta')) !!}
        {!! Form::text('seni_pencipta', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB E"]().seni_pencipta']) !!}
    </div>
    <!-- Seni Bahan Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('seni_bahan', __('field.seni_bahan')) !!}
        {!! Form::text('seni_bahan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB E"]().seni_bahan']) !!}
    </div>
</div>



<u class="col-md-12">Aset Biologis</u>

<div class="col-md-12">
    
    <!-- Ternak Jenis Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('ternak_jenis', __('field.ternak_jenis')) !!}
        {!! Form::text('ternak_jenis', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB E"]().ternak_jenis']) !!}
    </div>

    <!-- Ternak Ukuran Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('ternak_ukuran', __('field.ternak_ukuran')) !!}
        {!! Form::number('ternak_ukuran', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB E"]().ternak_ukuran']) !!}
    </div>

    <!-- Keterangan Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('keterangan', 'Keterangan:') !!}
        {!! Form::text('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB E"]().keterangan']) !!}
    </div>
</div>

<!-- Submit Field -->
@if(!isset($notShowSubmit))
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('detilasets.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif
