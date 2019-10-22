
<?php 
    $uniqId = uniqid();
    $inventaris = \App\Models\inventaris::find($detiltanah->pidinventaris);
?>

@include('inventaris.show_fields')

<!-- Separator Field -->
<div class="row">
    {!! Form::label('luas', 'DETIl KIB', ["class" => 'col-md-12 item-view text-left']) !!}
</div>

<!-- Luas Field -->
<div class="row">
    {!! Form::label('luas', 'Luas:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->luas !!}</p>
</div>

<!-- Alamat Field -->
<div class="row">
    {!! Form::label('alamat', 'Alamat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->alamat !!}</p>
</div>

<!-- Idkota Field -->
<div class="row">
    {!! Form::label('idkota', __('field.idkota'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiltanah->kota, "nama", "") !!}</p>
</div>

<!-- Idkecamatan Field -->
<div class="row">
    {!! Form::label('idkecamatan', __('field.idkecamatan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiltanah->kecamatan, "nama", "") !!}</p>
</div>

<!-- Idkelurahan Field -->
<div class="row">
    {!! Form::label('idkelurahan', __('field.idkelurahan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiltanah->kelurahan, "nama", "") !!}</p>
</div>

<!-- Koordinatlokasi Field -->
<div class="row">
    {!! Form::label('koordinatlokasi', 'Koordinat lokasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-non-draw-<?= $uniqId ?>"></p>
</div>

<!-- Koordinattanah Field -->
<div class="row">
    {!! Form::label('koordinattanah', 'Koordinat tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-<?= $uniqId ?>"></p>
</div>

<!-- Hak Field -->
<div class="row">
    {!! Form::label('hak', 'Hak:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->hak !!}</p>
</div>

<!-- Status Sertifikat Field -->
<div class="row">
    {!! Form::label('status_sertifikat', 'Status Sertifikat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->status_sertifikat !!}</p>
</div>

<!-- Tgl Sertifikat Field -->
<div class="row">
    {!! Form::label('tgl_sertifikat', 'Tgl Sertifikat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->tgl_sertifikat !!}</p>
</div>

<!-- Nama Sertifikat Field -->
<div class="row">
    {!! Form::label('nomor_sertifikat', 'Nama Sertifikat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->nomor_sertifikat !!}</p>
</div>

<!-- Penggunaan Field -->
<div class="row">
    {!! Form::label('penggunaan', 'Penggunaan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->penggunaan !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->keterangan !!}</p>
</div>

<script>

    window["map-<?= $uniqId ?>"] = () => {
        new MapInput(document.getElementsByClassName("map-<?= $uniqId ?>")[0], {
            value : <?= $detiltanah->koordinattanah ?>,
            draw: true,
        })

        new MapInput(document.getElementsByClassName("map-non-draw-<?= $uniqId ?>")[0], {
            value : "<?= $detiltanah->koordinatlokasi ?>",
            draw: false,
        })
    }
    
    // viewModel.jsLoaded.subscribe(() => {
    //     mainShow()
    // })

    window["map-<?= $uniqId ?>"]()
</script>
