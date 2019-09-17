
<!-- Nama Field -->
<div class="row">
    {!! Form::label('nama', 'Nama:', ["class" => 'col-md-4 item-view']) !!}
     <p class="col-md-8 item-view">{!! $jenisopd->nama !!}</p>
</div>

<!-- Aktif Field -->
<div class="row">
    {!! Form::label('aktif', 'Aktif:', ["class" => 'col-md-4 item-view']) !!}
     <p class="col-md-8 item-view">{!! \App\Models\BaseModel::$YesNoDs[$jenisopd->aktif] !!}</p>
</div>

