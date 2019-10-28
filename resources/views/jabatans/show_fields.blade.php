<!-- Nama Field -->
<div class="row">
    {!! Form::label('nama', 'Nama Jabatan Aset:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $jabatan->nama !!}</p>
</div>

<!-- Nama Jabatan Field -->
<div class="row">
    {!! Form::label('nama_jabatan', 'Nama Jabatan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $jabatan->nama_jabatan !!}</p>
</div>


<!-- Level Field -->
<div class="row">
    {!! Form::label('level', 'Level:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $jabatan->level !!}</p>
</div>