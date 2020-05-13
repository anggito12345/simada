<!-- Pidinventaris Field -->
<?php 
    $inventaris = \App\Models\inventaris::withTrashed()->join('m_barang','m_barang.id', 'inventaris.pidbarang')->find($pemeliharaan->pidinventaris)

?>
<div class="row">
    {!! Form::label('pidinventaris', 'Inventaris No Registrasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->noreg !!}</p>
</div>


<div class="row">
    {!! Form::label('pidinventaris', 'Inventaris Tahun Perolehan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->tahun_perolehan !!}</p>
</div>

<div class="row">
    {!! Form::label('pidinventaris', 'Inventaris Nama Barang:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $inventaris->nama_rek_aset !!}</p>
</div>
<!-- Tgl Field -->
<div class="row">
    {!! Form::label('tgl', 'Tanggal:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->tgl !!}</p>
</div>

<!-- Uraian Field -->
<div class="row">
    {!! Form::label('uraian', 'Uraian:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->uraian !!}</p>
</div>

<!-- Persh Field -->
<div class="row">
    {!! Form::label('persh', 'Perusahaan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->persh !!}</p>
</div>

<!-- Alamat Field -->
<div class="row">
    {!! Form::label('alamat', 'Alamat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->alamat !!}</p>
</div>

<!-- Nokontrak Field -->
<div class="row">
    {!! Form::label('nokontrak', 'No Kontrak:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->nokontrak !!}</p>
</div>

<!-- Tglkontrak Field -->
<div class="row">
    {!! Form::label('tglkontrak', 'Tgl Kontrak:', ["class" => 'col-md-4 item-view']) !!}
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
    <p class="col-md-8 item-view">{!! $pemeliharaan->menambah !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $pemeliharaan->keterangan !!}</p>
</div>

