<div class="row container bg-white">
    <u>Buku Perpustakaan</u>
    <!-- Buku Judul Field -->
    <div class="row">
        {!! Form::label('buku_judul', 'Judul/Pencipta:' , ["class" => 'col-md-4 item-view']) !!}
        <p class="col-md-8 item-view">{!! $detilaset->buku_judul !!}</p>
    </div>

    <!-- Buku Spesifikasi Field -->
    <div class="row">
        {!! Form::label('buku_spesifikasi', 'Spesifikasi:' , ["class" => 'col-md-4 item-view']) !!}
        <p class="col-md-8 item-view">{!! $detilaset->buku_spesifikasi !!}</p>
    </div>
</div>


<div class="row container bg-white">
    <u>Barang bercorak Kesenian/Kebudayaan</u>
    <!-- Seni Asal Field -->
    <div class="row">
        {!! Form::label('seni_asal', __('field.seni_asal') , ["class" => 'col-md-4 item-view']) !!}
        <p class="col-md-8 item-view">{!! $detilaset->seni_asal !!}</p>
    </div>

    <!-- Seni Pencipta Field -->
    <div class="row">
        {!! Form::label('seni_pencipta', __('field.seni_pencipta') , ["class" => 'col-md-4 item-view']) !!}
        <p class="col-md-8 item-view">{!! $detilaset->seni_pencipta !!}</p>
    </div>

    <!-- Seni Bahan Field -->
    <div class="row">
        {!! Form::label('seni_bahan', __('field.seni_bahan') , ["class" => 'col-md-4 item-view']) !!}
        <p class="col-md-8 item-view">{!! $detilaset->seni_bahan !!}</p>
    </div>
</div>

<div class="row container bg-white">
    <u>Hewan Ternak</u>

    <!-- Ternak Jenis Field -->
    <div class="row">
        {!! Form::label('ternak_jenis', __('field.ternak_jenis') , ["class" => 'col-md-4 item-view']) !!}
        <p class="col-md-8 item-view">{!! $detilaset->ternak_jenis !!}</p>
    </div>

    <!-- Ternak Ukuran Field -->
    <div class="row">
        {!! Form::label('ternak_ukuran', __('field.ternak_ukuran'), ["class" => 'col-md-4 item-view']) !!}
        <p class="col-md-8 item-view">{!! $detilaset->ternak_ukuran !!}</p>
    </div>

    <!-- Keterangan Field -->
    <div class="row">
        {!! Form::label('keterangan', 'Keterangan:' , ["class" => 'col-md-4 item-view']) !!}
        <p class="col-md-8 item-view">{!! $detilaset->keterangan !!}</p>
    </div>
</div>







