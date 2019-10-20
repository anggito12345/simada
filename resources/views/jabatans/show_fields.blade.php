<!-- Nama Field -->
<div class="row">
    {!! Form::label('nama', 'Nama:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $jabatan->nama !!}</p>
</div>

<!-- Jenis Field -->
<div class="row">
    {!! Form::label('jenis', 'Jenis:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($jabatan->jenisopd, "nama", "") !!}</p>
</div>
