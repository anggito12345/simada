<!-- Id Field
<div class="row col-sm-12">
    {!! Form::label('id', 'Id:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->id !!}</p>
</div>
 -->
<!-- Pidinventaris Field -->
<?php 
    $inventaris = \App\Models\inventaris::join('m_barang','m_barang.id', 'inventaris.pidbarang')->find($pemanfaatan->pidinventaris);
    $mitra = \App\Models\pemanfaatan::join('m_mitra','m_mitra.id', 'pemanfaatan.mitra')->find($pemanfaatan->mitra);
?>
<div class="row col-sm-12">
    {!! Form::label('pidinventaris', 'Inventaris No Registrasi', ["class" => 'col-md-3 item-view'], ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">: {!! $inventaris->noreg !!}</p>
</div>


<!-- Peruntukan Field -->
<div class="row col-sm-12">
    {!! Form::label('peruntukan', 'Peruntukan:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->peruntukan !!}</p>
</div>

<!-- Umur Field -->
<div class="row col-sm-12">
    {!! Form::label('umur', 'Umur:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->umur !!} {!! $pemanfaatan->umur_satuan !!}</p>
</div>

<!-- No Perjanjian Field -->
<div class="row col-sm-12">
    {!! Form::label('no_perjanjian', 'No Perjanjian:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->no_perjanjian !!}</p>
</div>

<!-- Tgl Mulai Field -->
<div class="row col-sm-12">
    {!! Form::label('tgl_mulai', 'Tgl Mulai:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->tgl_mulai !!}</p>
</div>

<!-- Tgl Akhir Field -->
<div class="row col-sm-12">
    {!! Form::label('tgl_akhir', 'Tgl Akhir:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->tgl_akhir !!}</p>
</div>

<!-- Mitra Field
<div class="row col-sm-12">
    {!! Form::label('mitra', 'Mitra:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view"></p>
</div> -->

<!-- Tipe Kontribusi Field -->
<div class="row col-sm-12">
    {!! Form::label('tipe_kontribusi', 'Tipe Kontribusi:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->tipe_kontribusi !!}</p>
</div>

<!-- Jumlah Kontribusi Field -->
<div class="row col-sm-12">
    {!! Form::label('jumlah_kontribusi', 'Jumlah Kontribusi:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->jumlah_kontribusi !!}</p>
</div>

<!-- Pegawai Field -->
<div class="row col-sm-12">
    {!! Form::label('pegawai', 'Pegawai:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->pegawai !!}</p>
</div>

<!-- Aktif Field -->
<div class="row col-sm-12">
    {!! Form::label('aktif', 'Aktif:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->aktif !!}</p>
</div>

<!-- Created At Field -->
<div class="row col-sm-12">
    {!! Form::label('created_at', 'Created At:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="row col-sm-12">
    {!! Form::label('updated_at', 'Updated At:', ["class" => 'col-md-3 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemanfaatan->updated_at !!}</p>
</div>

