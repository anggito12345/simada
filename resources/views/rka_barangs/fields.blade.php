<!-- Kode Organisasi Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_organisasi', 'Kode Organisasi:') !!}
    {!! Form::text('kode_organisasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Organisasi Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('nama_organisasi', 'Nama Organisasi:') !!}
    {!! Form::text('nama_organisasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Tahun Rka Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('tahun_rka', 'Tahun RKA:') !!}
    {!! Form::text('tahun_rka', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Barang Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_barang', 'Kode Barang:') !!}
    {!! Form::text('kode_barang', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Barang Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('nama_barang', 'Nama Barang:') !!}
    {!! Form::text('nama_barang', null, ['class' => 'form-control']) !!}
</div>

<!-- Jumlah Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('jumlah', 'Jumlah:') !!}
    {!! Form::number('jumlah', null, ['class' => 'form-control']) !!}
</div>

<!-- Harga Satuan Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('harga_satuan', 'Harga Satuan:') !!}
    {!! Form::number('harga_satuan', null, ['class' => 'form-control']) !!}
</div>

<!-- Nilai Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('nilai', 'Nilai:') !!}
    {!! Form::number('nilai', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('rkaBarangs.index') }}" class="btn btn-default">Cancel</a>
</div>
