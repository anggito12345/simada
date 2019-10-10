<!-- Tgl Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tgl', 'Tanggal Buku Pemeliharaan:') !!}
    {!! Form::text('tgl', null, ['class' => 'form-control','id'=>'tgl', 'data-bind' => 'value: viewModel.data.formPemeliharaan().tgl']) !!}
</div>

<!-- Uraian Field -->
<div class="form-group col-sm-12">
    {!! Form::label('uraian', 'Uraian Pemeliharaan:') !!}
    {!! Form::textarea('uraian', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().uraian']) !!}
</div>

<u class="col-md-12 no-padding">Yang memelihara:</u>

<div class="col-md-12">
    <!-- Persh Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('persh', 'Nama instansi/CV/PT:') !!}
        {!! Form::text('persh', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().persh']) !!}
    </div>

    <!-- Alamat Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('alamat', 'Alamat:') !!}
        {!! Form::text('alamat', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().alamat']) !!}
    </div>
</div>


<u class="col-md-12 no-padding">Surat Perjanjian/Kontrak:</u>

<div class="col-md-12">
    <!-- Nokontrak Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('nokontrak', 'Nomor:') !!}
        {!! Form::text('nokontrak', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().nokontrak']) !!}
    </div>

    <!-- Tglkontrak Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('tglkontrak', 'Tanggal:') !!}
        {!! Form::date('tglkontrak', null, ['class' => 'form-control','id'=>'tglkontrak', 'data-bind' => 'value: viewModel.data.formPemeliharaan().tglkontrak']) !!}
    </div>
</div>

<!-- Biaya Field -->
<div class="form-group col-sm-12">
    {!! Form::label('biaya', 'Biaya Pemeliharaan:') !!}
    {!! Form::text('biaya', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().biaya']) !!}
</div>

<!-- Menambah Field -->
<div class="form-group col-sm-12">
    {!! Form::label('menambah', 'Menambah Aset:') !!}
    {!! Form::checkbox('menambah', null, ['class' => 'form-control', 'value' => 1, 'data-bind' => 'checked: viewModel.data.formPemeliharaan().menambah']) !!} Ya
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().keterangan']) !!}
</div>

<script>
    viewModel.jsLoaded.subscribe(() => {
        new inlineDatepicker(document.getElementById('tgl'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });

        new inlineDatepicker(document.getElementById('tglkontrak'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });
        
    })
</script>