<?php 
    $uniqId = uniqid();
    $inventaris = \App\Models\inventaris::find($detilbangunan->pidinventaris);
?>

@include('inventaris.show_fields')

<!-- Separator Field -->
<div class="row">
    {!! Form::label('luas', 'DETIl KIB', ["class" => 'col-md-12 item-view text-left']) !!}
</div>

<!-- Konstruksi Field -->
<div class="row">
    {!! Form::label('konstruksi', 'Konstruksi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->konstruksi !!}</p>
</div>

<!-- Bertingkat Field -->
<div class="row">
    {!! Form::label('bertingkat', 'Bertingkat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$YesNoDs[$detilbangunan->bertingkat] !!}</p>
</div>

<!-- Beton Field -->
<div class="row">
    {!! Form::label('beton', 'Beton:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$YesNoDs[$detilbangunan->beton] !!}</p>
</div>

<!-- Luasbangunan Field -->
<div class="row">
    {!! Form::label('luasbangunan', 'Luas Bangunan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->luasbangunan !!}</p>
</div>

<!-- Alamat Field -->
<div class="row">
    {!! Form::label('alamat', 'Alamat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->alamat !!}</p>
</div>

<!-- Idkota Field -->
<div class="row">
    {!! Form::label('idkota', __('field.idkota'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilbangunan->kota, "nama", "") !!}</p>
</div>

<!-- Idkecamatan Field -->
<div class="row">
    {!! Form::label('idkecamatan', __('field.idkecamatan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilbangunan->kecamatan, "nama", "") !!}</p>
</div>

<!-- Idkelurahan Field -->
<div class="row">
    {!! Form::label('idkelurahan', __('field.idkelurahan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilbangunan->kelurahan, "nama", "") !!}</p>
</div>

<!-- Koordinatlokasi Field -->
<div class="row">
    {!! Form::label('koordinatlokasi', 'Koordinat Lokasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-non-draw-<?= $uniqId ?>"></p>
</div>

<!-- Koordinattanah Field -->
<div class="row">
    {!! Form::label('koordinattanah', 'Koordinat Tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-<?= $uniqId ?>"></p>
</div>

<!-- Tgldokumen Field -->
<div class="row">
    {!! Form::label('tgldokumen', 'Tanggal dokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->tgldokumen !!}</p>
</div>

<!-- Nodokumen Field -->
<div class="row">
    {!! Form::label('nodokumen', 'Nomor dokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view ">{!! $detilbangunan->nodokumen !!}</p>
</div>

<!-- Luastanah Field -->
<div class="row">
    {!! Form::label('luastanah', 'Luas tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->luastanah !!}</p>
</div>

<!-- Statustanah Field -->
<div class="row">
    {!! Form::label('statustanah', 'Status tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->statustanah !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->keterangan !!}</p>
</div>

<div class="row container bg-white">
    <u>KIB A:</u>
    <?php 
        $detiltanah = \App\Models\detiltanah::find($detilbangunan->kodetanah)
    ?>
    @if($detiltanah != null)
        @include('detiltanahs.show_fields')
    @endif
</div>


<script>

    window["map-<?= $uniqId ?>"] = () => {
        new GoogleMapInput(document.getElementsByClassName("map-<?= $uniqId ?>")[0], {
            value : <?= $detilbangunan->koordinattanah ?>,
            draw: true,
        })

        new GoogleMapInput(document.getElementsByClassName("map-non-draw-<?= $uniqId ?>")[0], {
            value : "<?= $detilbangunan->koordinatlokasi ?>",
            draw: false,
        })
    }
    
    // viewModel.jsLoaded.subscribe(() => {
    //     mainShow()
    // })

    window["map-<?= $uniqId ?>"]()
</script>
