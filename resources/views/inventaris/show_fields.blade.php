

<!-- Noreg Field -->
<div class="row">
    {!! Form::label('noreg', 'Noreg:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->noreg !!}</p>
</div>

<!-- kode propinsi Field -->
<div class="row">
    {!! Form::label('noreg', 'Kode Lokasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">
        <?php
            echo \App\Models\setting::where('nama', 'KODE_LOKASI_STATUS')->first()->nilai;
        ?>
    </p>
</div>

<!-- kode propinsi Field -->
<div class="row">
    {!! Form::label('noreg', 'Kode dan Nama Propinsi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">
        <?php
            echo \App\Models\BaseModel::getRelationData($inventaris->propinsi, "kode", "");
            echo " / ";
            echo \App\Models\BaseModel::getRelationData($inventaris->propinsi, "nama", "");
        ?>
    </p>
</div>

<!-- Kode dan Nama kota Field -->
<div class="row">
    {!! Form::label('noreg', 'Kode dan Nama Kabupaten/Kota:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">
        <?php
            echo \App\Models\BaseModel::getRelationData($inventaris->kota, "kode", "");
            echo " / ";
            echo \App\Models\BaseModel::getRelationData($inventaris->kota, "nama", "");
        ?>
    </p>
</div>

<!-- Nama kecamatan Field -->
<div class="row">
    {!! Form::label('noreg', 'Nama Kecamatan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">
        <?php
            echo \App\Models\BaseModel::getRelationData($inventaris->kecamatan, "nama", "");
        ?>
    </p>
</div>

<!-- Nama Kelurahan Field -->
<div class="row">
    {!! Form::label('noreg', 'Nama Kelurahan/Desa:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">
        <?php
            echo \App\Models\BaseModel::getRelationData($inventaris->Kelurahan, "nama", "");
        ?>
    </p>
</div>

<!-- Pidbarang Field -->
<div class="row">
    {!! Form::label('pidbarang', __('field.pidbarang'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($inventaris->barang, "nama_rek_aset", "") !!}</p>
</div>

<!-- Pidopd Field -->
<div class="row">
    {!! Form::label('pidopd', __('field.pidopd'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($inventaris->organisasi, "nama", "") !!}</p>
</div>

<!-- Pidopd Cabang Field -->
<div class="row">
    {!! Form::label('pidopd', __('field.pidopd_cabang'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($inventaris->organisasicabang, "nama", "") !!}</p>
</div>

<!-- PidUPT Field -->
<div class="row">
    {!! Form::label('pidopd', __('field.pidupt'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($inventaris->organisasiupt, "nama", "") !!}</p>
</div>

<!-- Tahun Perolehan Field -->
<div class="row">
    {!! Form::label('tahun_perolehan', 'Tahun Perolehan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->tahun_perolehan !!}</p>
</div>

<!-- Kode Lokasi Field -->
<div class="row">
    {!! Form::label('pidlokasi', __('field.kode_lokasi'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->kode_lokasi !!}</p>
</div>

<!-- Tgl Sensus Field -->
<div class="row">
    {!! Form::label('tgl_sensus', 'Tgl Sensus:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->tgl_sensus !!}</p>
</div>

<!-- Tgl Dibukukan Field -->
<div class="row">
    {!! Form::label('tgl_dibukukan', 'Tgl Perolehan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->tgl_dibukukan !!}</p>
</div>

<!-- Volume Field -->
<div class="row">
    {!! Form::label('volume', 'Volume:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->volume !!}</p>
</div>

<!-- Pembagi Field -->
<div class="row">
    {!! Form::label('pembagi', 'Pembagi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->pembagi !!}</p>
</div>

<!-- Satuan Field -->
<div class="row">
    {!! Form::label('satuan', 'Satuan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($inventaris->satuanmaster, "nama", "") !!}</p>
</div>

<!-- Harga Satuan Field -->
<div class="row">
    {!! Form::label('harga_satuan', 'Harga Satuan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->harga_satuan !!}</p>
</div>

<!-- Perolehan Field -->
<div class="row">
    {!! Form::label('perolehan', 'Perolehan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->perolehan !!}</p>
</div>

<!-- Kondisi Field -->
<div class="row">
    {!! Form::label('kondisi', 'Kondisi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$kondisiDs[$inventaris->kondisi] !!}</p>
</div>

<!-- Lokasi Detil Field -->
<div class="row">
    {!! Form::label('lokasi_detil', 'Lokasi Detil:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->lokasi_detil !!}</p>
</div>

<!-- Umur Ekonomis Field -->
<div class="row">
    {!! Form::label('umur_ekonomis', 'Umur Ekonomis:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->umur_ekonomis !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->keterangan !!}</p>
</div>

