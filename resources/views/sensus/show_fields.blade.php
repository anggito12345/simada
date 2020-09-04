


<div class="row">
    {!! Form::label('nama', 'Nama Barang:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisSensus->nama }}</p>
</div>


<div class="row">
    {!! Form::label('nama', 'Kode Barang:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisSensus->kode_barang }}</p>
</div>


<div class="row">
    {!! Form::label('status', 'Status:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ isset(Constant::$SENSUS_STATUS_01[$inventarisSensus->status_barang]) ? Constant::$SENSUS_STATUS_01[$inventarisSensus->status_barang] : '-' }}</p>
</div>


<!-- No Sk Field -->
<div class="row">
    {!! Form::label('no_sk', 'No SK:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisSensus->no_sk }}</p>
</div>

<!-- Tanggal Sk Field -->
<div class="row">
    {!! Form::label('tanggal_sk', 'Tanggal SK:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisSensus->tanggal_sk }}</p>
</div>


