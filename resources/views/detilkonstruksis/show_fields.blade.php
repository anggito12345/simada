<?php
    $uniqId = uniqid();
    $inventaris = \App\Models\inventaris::find($detilkonstruksi->pidinventaris);
?>

@include('inventaris.show_fields')

<!-- Separator Field -->
<div class="row">
    {!! Form::label('luas', 'DETIl KIB', ["class" => 'col-md-12 item-view text-left']) !!}
</div>

<!-- Konstruksi Field -->
<div class="row">
    {!! Form::label('konstruksi', 'Konstruksi:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->konstruksi !!}</p>
</div>

<!-- Bertingkat Field -->
<div class="row">
    {!! Form::label('bertingkat', 'Bertingkat:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$YesNoDs[$detilkonstruksi->bertingkat] !!}</p>
</div>

<!-- Beton Field -->
<div class="row">
    {!! Form::label('beton', 'Beton:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$YesNoDs[$detilkonstruksi->beton] !!}</p>
</div>

<!-- Luasbangunan Field -->
<div class="row">
    {!! Form::label('luasbangunan', 'Luas Bangunan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->luasbangunan !!}</p>
</div>

<!-- Alamat Field -->
<div class="row">
    {!! Form::label('alamat', 'Alamat:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->alamat !!}</p>
</div>

<!-- Koordinatlokasi Field -->
<div class="row">
    {!! Form::label('koordinatlokasi', 'Koordinat Lokasi:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-non-draw-<?= $detilkonstruksi->id ?>">{!! $detilkonstruksi->koordinatlokasi !!}</p>
</div>

<!-- Koordinattanah Field -->
<div class="row">
    {!! Form::label('koordinattanah', 'Koordinat Tanah:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-<?= $detilkonstruksi->id ?>">{!! $detilkonstruksi->koordinattanah !!}</p>
</div>

<!-- Tglmulai Field -->
<div class="row">
    {!! Form::label('tglmulai', 'Tanggal Mulai:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->tglmulai !!}</p>
</div>

<!-- Tgldokumen Field -->
<div class="row">
    {!! Form::label('tgldokumen', 'Tanggal Dokumen:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->tgldokumen !!}</p>
</div>

<!-- Nodokumen Field -->
<div class="row">
    {!! Form::label('nodokumen', 'Nomor Dokumen:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->nodokumen !!}</p>
</div>

{{-- <!-- Luastanah Field -->
<div class="row">
    {!! Form::label('luastanah', 'Luas Tanah:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->luastanah !!}</p>
</div> --}}

<!-- Statustanah Field -->
<div class="row">
    {!! Form::label('statustanah', 'Status Tanah:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->statustanah !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->keterangan !!}</p>
</div>


<div class="row container bg-white">
    <u>KIB A:</u>
    <?php
        $detiltanah = \App\Models\detiltanah::find($detilkonstruksi->kodetanah)
    ?>

    @if($detiltanah != null)
        @include('detiltanahs.show_fields')
    @endif
</div>
