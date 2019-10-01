
<!-- Merk Field -->
<div class="row">
    {!! Form::label('merk', 'Merk:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilmesin->merkbarang, "nama", "") !!}</p>
</div>

<!-- Ukuran Field -->
<div class="row">
    {!! Form::label('ukuran', 'Ukuran:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilmesin->ukuran !!}</p>
</div>

<!-- Bahan Field -->
<div class="row">
    {!! Form::label('bahan', 'Bahan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilmesin->bahan !!}</p>
</div>

<!-- Norangka Field -->
<div class="row">
    {!! Form::label('norangka', 'No Rangka:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilmesin->norangka !!}</p>
</div>

<!-- Nomesin Field -->
<div class="row">
    {!! Form::label('nomesin', 'No Mesin:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilmesin->nomesin !!}</p>
</div>

<!-- Nopol Field -->
<div class="row">
    {!! Form::label('nopol', 'Nopol:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilmesin->nopol !!}</p>
</div>

<!-- Bpkb Field -->
<div class="row">
    {!! Form::label('bpkb', __('field.bpkb'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilmesin->bpkb !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilmesin->keterangan !!}</p>
</div>

<!-- Dokumen Field -->
<!-- <div class="row">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    <p class="col-md-8 item-view">{!! $detilmesin->dokumen !!}</p>
</div> -->

<!-- Foto Field -->
<!-- <div class="row">
    {!! Form::label('foto', 'Foto:') !!}
    <p class="col-md-8 item-view">{!! $detilmesin->foto !!}</p>
</div> -->

<!-- Created At Field -->
<!-- <div class="row">
    {!! Form::label('created_at', 'Created At:') !!}
    <p class="col-md-8 item-view">{!! $detilmesin->created_at !!}</p>
</div> -->

<!-- Updated At Field -->
<!-- <div class="row">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p class="col-md-8 item-view">{!! $detilmesin->updated_at !!}</p>
</div> -->

