<!-- Deskripsi Field -->
<div class="row">
    {!! Form::label('deskripsi', 'Deskripsi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->deskripsi }}</p>
</div>

<!-- Beban Penyusutan Perbulan Field -->
<div class="row">
    {!! Form::label('beban_penyusutan_perbulan', 'Beban Penyusutan Perbulan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->beban_penyusutan_perbulan }}</p>
</div>

<!-- Masa Manfaat Sd Akhir Tahun Field -->
<div class="row">
    {!! Form::label('masa_manfaat_sd_akhir_tahun', 'Masa Manfaat Sd Akhir Tahun:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->masa_manfaat_sd_akhir_tahun }}</p>
</div>

<!-- Penyusutan Sd Tahun Sebelumnya Field -->
<div class="row">
    {!! Form::label('penyusutan_sd_tahun_sebelumnya', 'Penyusutan Sd Tahun Sebelumnya:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->penyusutan_sd_tahun_sebelumnya }}</p>
</div>

<!-- Running Penyesutan Field -->
<div class="row">
    {!! Form::label('running_penyesutan', 'Running Penyusutan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->running_penyusutan }}</p>
</div>

<!-- Running Sd Bulan Field -->
<div class="row">
    {!! Form::label('running_sd_bulan', 'Running Sd Bulan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->running_sd_bulan }}</p>
</div>

<!-- Penyusutan Tahun Sekarang Field -->
<div class="row">
    {!! Form::label('penyusutan_tahun_sekarang', 'Penyusutan Tahun Sekarang:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->penyusutan_tahun_sekarang }}</p>
</div>

<!-- Penyusutan Sd Tahun Sekarang Field -->
<div class="row">
    {!! Form::label('penyusutan_sd_tahun_sekarang', 'Penyusutan Sd Tahun Sekarang:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->penyusutan_sd_tahun_sekarang }}</p>
</div>

<!-- Created At Field -->
<div class="row">
    {!! Form::label('created_at', 'Created At:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="row">
    {!! Form::label('updated_at', 'Updated At:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{{ $inventarisPenyusutan->updated_at }}</p>
</div>

