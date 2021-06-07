
<?php
    $uniqId = uniqid();
    $inventaris = \App\Models\inventaris::withTrashed()->withDrafts()->find($detiltanah->pidinventaris);
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

<!-- Nilai HBU Field -->
<div class="row">
    {!! Form::label('nilai_hub', 'Nilai HBU:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->nilai_hub !!}</p>
</div>

<!-- Tipe Field -->
<div class="row">
    {!! Form::label('tipe', 'Tipe:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->tipe !!}</p>
</div>

<!-- Koordinatlokasi Field -->
<div class="row">
    {!! Form::label('koordinatlokasi', 'Koordinat lokasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-non-draw-<?= $detiltanah->pidinventaris ?>" >
        {!! $detiltanah->koordinatlokasi !!}
    </p>
</div>

<!-- Koordinattanah Field -->
<div class="row">
    {!! Form::label('koordinattanah', 'Koordinat tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view map-<?= $detiltanah->pidinventaris ?>" >
        {!! $detiltanah->koordinattanah !!}
    </p>
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

@if ($detiltanah->status_sertifikat != 'Tidak Ada') 
<!-- Tgl Sertifikat Field -->
<div class="row">
    {!! Form::label('tgl_sertifikat', 'Tgl Sertifikat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->tgl_sertifikat !!}</p>
</div>

<!-- Nama Sertifikat Field -->
<div class="row">
    {!! Form::label('nomor_sertifikat', 'Nomor Sertifikat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->nomor_sertifikat !!}</p>
</div>
@endif

<!-- Penggunaan Field -->
<div class="row">
    {!! Form::label('penggunaan', 'Penggunaan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiltanah->penggunaanmaster, "nama", "") !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->keterangan !!}</p>
</div>

@section('scripts')
<script>

</script>
@endsection
