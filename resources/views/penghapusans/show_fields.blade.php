<!-- Pidinventaris Field -->
<div class="row">
    {!! Form::label('pidinventaris', __('field.pidinventaris'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($penghapusan->inventaris, "noreg", "") !!}</p>
</div>

<!-- Noreg Field -->
<div class="row">
    {!! Form::label('noreg', __('field.noreg'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->noreg !!}</p>
</div>

<!-- Tglhapus Field -->
<div class="row">
    {!! Form::label('tglhapus', __('field.tglhapus'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->tglhapus !!}</p>
</div>

<!-- Kriteria Field -->
<div class="row">
    {!! Form::label('kriteria', 'Kriteria:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->kriteria !!}</p>
</div>

<!-- Kondisi Field -->
<div class="row">
    {!! Form::label('kondisi', 'Kondisi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->kondisi !!}</p>
</div>

<!-- Harga Apprisal Field -->
<div class="row">
    {!! Form::label('harga_apprisal', 'Harga Apprisal:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->harga_apprisal !!}</p>
</div>

<!-- Dokumen Field -->
<div class="row">
    {!! Form::label('dokumen', 'Dokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Helpers\FileHelpers::showFile(url("") . "" . Storage::url($penghapusan->dokumen)) !!}</p>
</div>

<!-- Foto Field -->
<div class="row">
    {!! Form::label('foto', 'Foto:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Helpers\FileHelpers::showFile(url("") . "" . Storage::url($penghapusan->foto)) !!}</p>
</div>

<!-- Nosk Field -->
<div class="row">
    {!! Form::label('nosk', 'No sk:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->nosk !!}</p>
</div>

<!-- Tglsk Field -->
<div class="row">
    {!! Form::label('tglsk', 'Tgl sk:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->tglsk !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $penghapusan->keterangan !!}</p>
</div>

