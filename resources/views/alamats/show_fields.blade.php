

<!-- Pid Field -->
<div class="row">
    {!! Form::label('pid', __('field.pid'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($alamat->alamat, "nama", "") !!}</p>
</div>

<!-- Kode Field -->
<div class="row">
    {!! Form::label('kode', 'Kode:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $alamat->kode !!}</p>
</div>

<!-- Nama Field -->
<div class="row">
    {!! Form::label('nama', 'Nama:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $alamat->nama !!}</p>
</div>

<!-- Jenis Field -->
<div class="row">
    {!! Form::label('jenis', 'Jenis:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$jenisKotaDs[$alamat->jenis]; !!}</p>
</div>

<!-- Kodepos Field -->
<div class="row">
    {!! Form::label('kodepos', 'Kodepos:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $alamat->kodepos !!}</p>
</div>

