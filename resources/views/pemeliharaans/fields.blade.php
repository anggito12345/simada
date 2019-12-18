@if(!isset($isInventarisPage))
<!-- pid Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('pidinventaris', 'Inventaris:') !!}
    {!! Form::text('pidinventaris', null, ['id' => 'pidinventaris_pemeliharaan', 'class' => 'form-control']) !!}
</div>
@endif

<!-- Tgl Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('tgl', 'Tanggal Buku Pemeliharaan:') !!}
    {!! Form::text('tgl', null, ['class' => 'form-control','id'=>'tgl']) !!}
</div>

<!-- Uraian Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('uraian', 'Uraian Pemeliharaan:') !!}
    {!! Form::textarea('uraian', null, ['class' => 'form-control']) !!}
</div>

<u class="col-md-12 no-padding">Yang memelihara:</u>

<div class="col-md-12">
    <!-- Persh Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('persh', 'Nama instansi/CV/PT:') !!}
        {!! Form::text('persh', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Alamat Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('alamat', 'Alamat:') !!}
        {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
    </div>
</div>


<u class="col-md-12 no-padding">Surat Perjanjian/Kontrak:</u>

<div class="col-md-12">
    <!-- Nokontrak Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('nokontrak', 'Nomor:') !!}
        {!! Form::text('nokontrak', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Tglkontrak Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('tglkontrak', 'Tanggal:') !!}
        {!! Form::text('tglkontrak', null, ['class' => 'form-control','id'=>'tglkontrak']) !!}
    </div>
</div>

<!-- Biaya Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('biaya', 'Biaya Pemeliharaan:') !!}
    {!! Form::number('biaya', null, ['class' => 'form-control']) !!}
</div>

<!-- Umur Ekonomis Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('umur_ekonomis', 'Umur Ekonomis:') !!}
    {!! Form::number('umur_ekonomis', 0, [ 'class' => 'form-control']) !!}
</div>

<!-- Menambah Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('menambah', 'Menambah Aset:') !!}
    {!! Form::checkbox('menambah', 0, [ 'class' => 'form-control', 'value' => 1]) !!} Ya
</div>

<!-- Keterangan Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('draft', '', []) !!}

<div class="form-group col-sm-6">
    <div class="btn btn-primary" onclick="doSave(false)">Save</div>
    @if(isset($pemeliharaan) && !empty($pemeliharaan->draft) || !isset($pemeliharaan))
        <div class="btn btn-primary" onclick="doSave(true)">Draft</div>
    @endif 
    <a href="{!! route('pemeliharaans.index') !!}" class="btn btn-default">Cancel</a>
</div>



@if(!isset($isInventarisPage))
    @section('scripts')
        @include('pemeliharaans.js')
    @endsection
@else
    @include('pemeliharaans.js')
@endif