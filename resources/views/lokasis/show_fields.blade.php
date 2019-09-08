
<!-- Pid Field -->
<div class="row">
    {!! Form::label('pid', 'Pid:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $lokasi->pid !!}</p>
</div>

<!-- Nama Field -->
<div class="row">
    {!! Form::label('nama', 'Nama:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $lokasi->nama !!}</p>
</div>

<!-- Aktif Field -->
<div class="row">
    {!! Form::label('aktif', 'Aktif:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $lokasi->aktif !!}</p>
</div>

