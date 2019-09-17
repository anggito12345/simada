
<!-- Pidinventaris Field -->
<div class="row">
    {!! Form::label('pidinventaris', 'Pidinventaris:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($pemeliharaan->inventaris, "noreg", "") !!}</p>
</div>

<!-- Tgl Field -->
<div class="row">
    {!! Form::label('tgl', 'Tgl:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->tgl !!}</p>
</div>

<!-- Uraian Field -->
<div class="row">
    {!! Form::label('uraian', 'Uraian:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->uraian !!}</p>
</div>

<!-- Persh Field -->
<div class="row">
    {!! Form::label('persh', 'Persh:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->persh !!}</p>
</div>

<!-- Alamat Field -->
<div class="row">
    {!! Form::label('alamat', 'Alamat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->alamat !!}</p>
</div>

<!-- Nokontrak Field -->
<div class="row">
    {!! Form::label('nokontrak', 'Nokontrak:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->nokontrak !!}</p>
</div>

<!-- Tglkontrak Field -->
<div class="row">
    {!! Form::label('tglkontrak', 'Tglkontrak:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->tglkontrak !!}</p>
</div>

<!-- Biaya Field -->
<div class="row">
    {!! Form::label('biaya', 'Biaya:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->biaya !!}</p>
</div>

<!-- Menambah Field -->
<div class="row">
    {!! Form::label('menambah', 'Menambah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$YesNoDs[$pemeliharaan->menambah] !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->keterangan !!}</p>
</div>

