
<?php 
    $uniqId = uniqid()
?>


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


<!-- Idkota Field -->
<div class="row">
    {!! Form::label('idkota', __('field.idkota'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilkonstruksi->kota, "nama", "") !!}</p>
</div>

<!-- Idkecamatan Field -->
<div class="row">
    {!! Form::label('idkecamatan', __('field.idkecamatan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilkonstruksi->kecamatan, "nama", "") !!}</p>
</div>

<!-- Idkelurahan Field -->
<div class="row">
    {!! Form::label('idkelurahan', __('field.idkelurahan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilkonstruksi->kelurahan, "nama", "") !!}</p>
</div>

<!-- Koordinatlokasi Field -->
<div class="row">
    {!! Form::label('koordinatlokasi', 'Koordinat Lokasi:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-non-draw-<?= $uniqId ?>">{!! $detilkonstruksi->koordinatlokasi !!}</p>
</div>

<!-- Koordinattanah Field -->
<div class="row">
    {!! Form::label('koordinattanah', 'Koordinat Tanah:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-<?= $uniqId ?>">{!! $detilkonstruksi->koordinattanah !!}</p>
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

<!-- Luastanah Field -->
<div class="row">
    {!! Form::label('luastanah', 'Luas Tanah:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->luastanah !!}</p>
</div>

<!-- Statustanah Field -->
<div class="row">
    {!! Form::label('statustanah', 'Status Tanah:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->statustanah !!}</p>
</div>

<!-- Kodetanah Field -->
<div class="row">
    {!! Form::label('kodetanah', 'Kode Tanah:' , ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilkonstruksi->kodetanah !!}</p>
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
<script>

    window["map-<?= $uniqId ?>"] = () => {
        new MapInput(document.getElementsByClassName("map-<?= $uniqId ?>")[0], {
            value : <?= $detilkonstruksi->koordinattanah ?>,
            draw: true,
        })

        new MapInput(document.getElementsByClassName("map-non-draw-<?= $uniqId ?>")[0], {
            value : "<?= $detilkonstruksi->koordinatlokasi ?>",
            draw: false,
        })
    }
    
    // viewModel.jsLoaded.subscribe(() => {
    //     mainShow()
    // })

    window["map-<?= $uniqId ?>"]()
</script>