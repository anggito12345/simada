<!-- Pidinventaris Field -->
<div class="row">
    {!! Form::label('pidinventaris', __('field.pidinventaris'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detiltanah->inventaris, "noreg", "") !!}</p>
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
    <p class="col-md-8 item-view">{!! $detiltanah->koordinatlokasi !!}</p>
</div>

<!-- Koordinattanah Field -->
<div class="row">
    {!! Form::label('koordinattanah', 'Koordinat tanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->koordinattanah !!}</p>
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
    {!! Form::label('nama_sertifikat', 'Nama Sertifikat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detiltanah->nama_sertifikat !!}</p>
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

<!-- Dokumen Field -->
<div class="row">
    {!! Form::label('dokumen', 'Dokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Helpers\FileHelpers::showFile(url("") . "" . Storage::url($detiltanah->dokumen)) !!}</p>
</div>

<!-- Foto Field -->
<div class="row">
    {!! Form::label('foto', 'Foto:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Helpers\FileHelpers::showFile(url("") . "" . Storage::url($detiltanah->foto)) !!}</p>
</div>

