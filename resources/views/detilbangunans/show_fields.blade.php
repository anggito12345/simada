

<!-- Pidinventaris Field -->
<div class="row">
    {!! Form::label('pidinventaris', __('field.pidinventaris'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilbangunan->inventaris, "noreg", "") !!}</p>
</div>

<!-- Konstruksi Field -->
<div class="row">
    {!! Form::label('konstruksi', 'Konstruksi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->konstruksi !!}</p>
</div>

<!-- Bertingkat Field -->
<div class="row">
    {!! Form::label('bertingkat', 'Bertingkat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->bertingkat !!}</p>
</div>

<!-- Beton Field -->
<div class="row">
    {!! Form::label('beton', 'Beton:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->beton !!}</p>
</div>

<!-- Luasbangunan Field -->
<div class="row">
    {!! Form::label('luasbangunan', 'Luasbangunan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->luasbangunan !!}</p>
</div>

<!-- Alamat Field -->
<div class="row">
    {!! Form::label('alamat', 'Alamat:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->alamat !!}</p>
</div>

<!-- Idkota Field -->
<div class="row">
    {!! Form::label('idkota', __('field.idkota'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilbangunan->kota, "nama", "") !!}</p>
</div>

<!-- Idkecamatan Field -->
<div class="row">
    {!! Form::label('idkecamatan', __('field.idkecamatan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilbangunan->kecamatan, "nama", "") !!}</p>
</div>

<!-- Idkelurahan Field -->
<div class="row">
    {!! Form::label('idkelurahan', __('field.idkelurahan'), ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! \App\Models\BaseModel::getRelationData($detilbangunan->kelurahan, "nama", "") !!}</p>
</div>

<!-- Koordinatlokasi Field -->
<div class="row">
    {!! Form::label('koordinatlokasi', 'Koordinatlokasi:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->koordinatlokasi !!}</p>
</div>

<!-- Koordinattanah Field -->
<div class="row">
    {!! Form::label('koordinattanah', 'Koordinattanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->koordinattanah !!}</p>
</div>

<!-- Tgldokumen Field -->
<div class="row">
    {!! Form::label('tgldokumen', 'Tgldokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->tgldokumen !!}</p>
</div>

<!-- Nodokumen Field -->
<div class="row">
    {!! Form::label('nodokumen', 'Nodokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->nodokumen !!}</p>
</div>

<!-- Luastanah Field -->
<div class="row">
    {!! Form::label('luastanah', 'Luastanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->luastanah !!}</p>
</div>

<!-- Statustanah Field -->
<div class="row">
    {!! Form::label('statustanah', 'Statustanah:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->statustanah !!}</p>
</div>

<!-- Keterangan Field -->
<div class="row">
    {!! Form::label('keterangan', 'Keterangan:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->keterangan !!}</p>
</div>

<!-- Kodetanah Field -->
<div class="row">
    <div class="box box-primary">
        <div class="box-header bg-blue" >
            <div class="collapse-toggle" data-toggle="collapse" data-target="#detilkodetanah">
                KIB A:
            </div>
        </div>
        <div class="box-body collapse" id="detilkodetanah">
            <div class="container container-view" style="padding-left: 20px">
                <?php 
                    $detiltanah = \App\Models\detiltanah::find($detilbangunan->kodetanah)
                ?>
                <div class="container container-view">
                    @include('detiltanahs.show_fields')
                </div>                    
            </div>                
        </div>
    </div>        
</div>

<!-- Dokumen Field -->
<!-- <div class="row">
    {!! Form::label('dokumen', 'Dokumen:', ["class" => 'col-md-4 item-view']) !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->dokumen !!}</p>
</div> -->


<!-- Foto Field -->
<!-- <div class="row">
    {!! Form::label('foto', 'Foto:') !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->foto !!}</p>
</div> -->

<!-- Created At Field -->
<!-- <div class="row">
    {!! Form::label('created_at', 'Created At:') !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->created_at !!}</p>
</div> -->

<!-- Updated At Field -->
<!-- <div class="row">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p class="col-md-8 item-view">{!! $detilbangunan->updated_at !!}</p>
</div> -->

