

<!-- Pid Field -->
<div class="row">
    {!! Form::label('pid', 'Induk Organisasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($organisasi->organisasi, "nama", "") !!}</p>
</div>

<!-- Nama Field -->
<div class="row">
    {!! Form::label('nama', 'Nama:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $organisasi->nama !!}</p>
</div>

<!-- Jenis Field -->
<div class="row">
    {!! Form::label('jenis', 'Level:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$levelOrganisasiDs[$organisasi->level] !!}</p>
</div>

<!-- Alamat Field -->
<div class="row">
    {!! Form::label('alamat', 'Alamat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $organisasi->alamat !!}</p>
</div>

<!-- Aktif Field -->
<div class="row">
    {!! Form::label('aktif', 'Aktif:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$YesNoDs[$organisasi->aktif] !!}</p>
</div>

