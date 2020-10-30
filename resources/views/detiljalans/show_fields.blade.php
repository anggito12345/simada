<?php
    $uniqId = uniqid();
    $inventaris = \App\Models\inventaris::find($detiljalan->pidinventaris);
?>

@include('inventaris.show_fields')

<!-- Separator Field -->
<div class="row">
    {!! Form::label('luas', 'DETIl KIB', ["class" => 'col-md-12 item-view text-left']) !!}
</div>

<!-- Nilai HBU Field -->
<div class="row">
    {!! Form::label('nilai_hub_kibd', 'Nilai HBU:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->nilai_hub !!}</p>
</div>

<!-- Tipe Field -->
<div class="row">
    {!! Form::label('tipe_kibd', 'Tipe:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->tipe !!}</p>
</div>

<!-- Kode jalan field -->
<div class="row">
    {!! Form::label('kodejalan', 'Kode Jalan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiljalan->kodejalanmaster, "nama", "") !!}</p>
</div>

<!-- Konstruksi Field -->
<div class="row">
    {!! Form::label('konstruksi', 'Konstruksi:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->konstruksi !!}</p>
</div>

<!-- Panjang Field -->
<div class="row">
    {!! Form::label('panjang', 'Panjang:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->panjang !!}</p>
</div>

<!-- Lebar Field -->
<div class="row">
    {!! Form::label('lebar', 'Lebar:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->lebar !!}</p>
</div>

<!-- Luas Field -->
<div class="row">
    {!! Form::label('luas', 'Luas:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->luas !!}</p>
</div>

<!-- Alamat Field -->
<div class="row">
    {!! Form::label('alamat', 'Alamat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->alamat !!}</p>
</div>

<!-- Koordinatlokasi Field -->
<div class="row">
    {!! Form::label('koordinatlokasi', 'Koordinat Lokasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-non-draw-<?= $detiljalan->pidinventaris ?>">{!! $detiljalan->koordinatlokasi !!}</p>
</div>

<!-- Koordinattanah Field -->
<div class="row">
    {!! Form::label('koordinattanah', 'Koordinat Tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-<?= $detiljalan->pidinventaris ?>">{!! $detiljalan->koordinattanah !!}</p>
</div>

<!-- Tgldokumen Field -->
<div class="row">
    {!! Form::label('tgldokumen', 'Tanggal Dokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->tgldokumen !!}</p>
</div>

<!-- Nodokumen Field -->
<div class="row">
    {!! Form::label('nodokumen', 'Nomor Dokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->nodokumen !!}</p>
</div>

<!-- Luastanah Field -->
{{-- <div class="row">
    {!! Form::label('luastanah', 'Luas Tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->luastanah !!}</p>
</div> --}}

<!-- Statustanah Field -->
<div class="row">
    {!! Form::label('statustanah', 'Status Tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiljalan->statustanahmaster, "nama", "") !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->keterangan !!}</p>
</div>

<div class="row container bg-white">
    <u>KIB A:</u>
    <?php
        $detiltanah = \App\Models\detiltanah::find($detiljalan->kodetanah)
    ?>
    @if($detiltanah != null)
        @include('detiltanahs.show_fields')
    @endif
</div>



