
<!-- Pid Field -->
<div class="row">
    {!! Form::label('pid', __('field.pid'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($barang->barang, "nama_rek_aset", "") !!}</p>
</div>

<!-- Kodetampil Field -->
<div class="row">
    {!! Form::label('kodetampil', 'Kodetampil:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $barang->kodetampil !!}</p>
</div>

<!-- Kode Rek Field -->
<div class="row">
    {!! Form::label('kode_rek', 'Kode Rek:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $barang->kode_rek !!}</p>
</div>

<!-- Nama Rek Aset Field -->
<div class="row">
    {!! Form::label('nama_rek_aset', 'Nama Rek Aset:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $barang->nama_rek_aset !!}</p>
</div>

<!-- Jenis Barang Field -->
<div class="row">
    {!! Form::label('jenis_barang', 'Jenis Barang:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $barang->jenis_barang !!}</p>
</div>

<!-- Umur Ekononomis Field -->
<div class="row">
    {!! Form::label('umur_ekononomis', 'Umur Ekononomis:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $barang->umur_ekononomis !!}</p>
</div>

<!-- Aset Field -->
<div class="row">
    {!! Form::label('aset', 'Aset:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $barang->aset !!}</p>
</div>

<!-- Obyek Field -->
<div class="row">
    {!! Form::label('obyek', 'Obyek:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $barang->obyek !!}</p>
</div>

<!-- Rincianobyek Field -->
<div class="row">
    {!! Form::label('rincianobyek', 'Rincian Obyek:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $barang->rincianobyek !!}</p>
</div>

<!-- Subrincianobyek Field -->
<div class="row">
    {!! Form::label('subrincianobyek', 'Subrincian Obyek:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $barang->subrincianobyek !!}</p>
</div>

