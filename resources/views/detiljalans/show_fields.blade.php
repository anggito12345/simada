
<?php 
    $uniqId = uniqid()
?>

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

<!-- Idkota Field -->
<div class="row">
    {!! Form::label('idkota', __('field.idkota'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiljalan->kota, "nama", "") !!}</p>
</div>

<!-- Idkecamatan Field -->
<div class="row">
    {!! Form::label('idkecamatan', __('field.idkecamatan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiljalan->kecamatan, "nama", "") !!}</p>
</div>

<!-- Idkelurahan Field -->
<div class="row">
    {!! Form::label('idkelurahan', __('field.idkelurahan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiljalan->kelurahan, "nama", "") !!}</p>
</div>

<!-- Koordinatlokasi Field -->
<div class="row">
    {!! Form::label('koordinatlokasi', 'Koordinat Lokasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-non-draw-<?= $uniqId ?>">{!! $detiljalan->koordinatlokasi !!}</p>
</div>

<!-- Koordinattanah Field -->
<div class="row">
    {!! Form::label('koordinattanah', 'Koordinat Tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-<?= $uniqId ?>">{!! $detiljalan->koordinattanah !!}</p>
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
<div class="row">
    {!! Form::label('luastanah', 'Luas Tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->luastanah !!}</p>
</div>

<!-- Statustanah Field -->
<div class="row">
    {!! Form::label('statustanah', 'Status Tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->statustanah !!}</p>
</div>

<!-- Kodetanah Field -->
<div class="row">
    {!! Form::label('kodetanah', 'Kode Tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->kodetanah !!}</p>
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


<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiljalan->keterangan !!}</p>
</div>

<script>

    window["map-<?= $uniqId ?>"] = () => {
        new MapInput(document.getElementsByClassName("map-<?= $uniqId ?>")[0], {
            value : <?= $detiljalan->koordinattanah ?>,
            draw: true,
        })

        new MapInput(document.getElementsByClassName("map-non-draw-<?= $uniqId ?>")[0], {
            value : "<?= $detiljalan->koordinatlokasi ?>",
            draw: false,
        })
    }
    
    // viewModel.jsLoaded.subscribe(() => {
    //     mainShow()
    // })

    window["map-<?= $uniqId ?>"]()
</script>