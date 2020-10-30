<!-- Kodetanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kodetanah', 'Nomor Kode Tanah:') !!}
    {!! Form::select('kodetanah',[], null, ['class' => 'form-control', 'id' => 'kodetanah-detilkonstruksi', 'data-bind' => 'value: viewModel.data["KIB F"]().kodetanah']) !!}
</div>

<!-- Konstruksi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('konstruksi', 'Konstruksi:') !!}
    {!! Form::text('konstruksi', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB F"]().konstruksi']) !!}
</div>

<u class="col-md-12">Konstruksi Bangunan</u>

<div class="col-md-12">

    <!-- Bertingkat Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('bertingkat', 'Bertingkat:') !!}
        <div class="radio">
            {!! Form::radio('bertingkat', 1, isset($detilkonstruksi) ? $detilkonstruksi->bertingkat == 1 : false, ['data-bind' => 'checked: viewModel.data["KIB F"]().bertingkat']) !!} Ya
            {!! Form::radio('bertingkat', 0, isset($detilkonstruksi) ? $detilkonstruksi->bertingkat == 0 : false, ['data-bind' => 'checked: viewModel.data["KIB F"]().bertingkat']) !!} Tidak
        </div>
    </div>

    <!-- Beton Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('beton', 'Beton:') !!}
        <div class="radio">
            {!! Form::radio('beton', 1, isset($detilkonstruksi) ? $detilkonstruksi->beton == 1 : false, ['data-bind' => 'checked: viewModel.data["KIB F"]().beton']) !!} Ya
            {!! Form::radio('beton', 0, isset($detilkonstruksi) ? $detilkonstruksi->beton == 0 : false, ['data-bind' => 'checked: viewModel.data["KIB F"]().beton']) !!} Tidak
        </div>
    </div>
</div>

<!-- Luasbangunan Field -->
<div class="form-group col-sm-6">
    <?= Form::label('luasbangunan', 'Luas (m<sup>2</sup>):') ?>
    {!! Form::number('luasbangunan', null, ['class' => 'form-control', 'id' => 'luasbangunan-detilkonstruksi', 'data-bind' => 'value: viewModel.data["KIB F"]().luasbangunan']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alamat', 'Letak/Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB F"]().alamat']) !!}
</div>


<!-- Koordinatlokasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('koordinatlokasi', 'Koordinat Lokasi:') !!}
    {!! Form::text('koordinatlokasi', null, ['class' => 'form-control', 'id' => 'koordinatlokasi-detilkonstruksi', 'data-bind' => 'value: viewModel.data["KIB F"]().koordinatlokasi']) !!}
</div>

<!-- Koordinattanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('koordinattanah', 'Koordinat Tanah:') !!}
    {!! Form::text('koordinattanah', null, ['class' => 'form-control', 'id' => 'koordinattanah-detilkonstruksi', 'data-bind' => 'value: viewModel.data["KIB F"]().koordinattanah']) !!}
</div>

<u class="col-md-12">Dokumen</u>

<div class="col-md-12">

    <!-- Tgldokumen Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('tgldokumen', 'Tanggal:') !!}
        {!! Form::text('tgldokumen', null, ['class' => 'form-control','id'=>'tgldokumen', 'id' => 'tgldokumen-detilkonstruksi', 'data-bind' => 'value: viewModel.data["KIB F"]().tgldokumen']) !!}
    </div>


    <!-- Nodokumen Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('nodokumen', 'Nomor:') !!}
        {!! Form::text('nodokumen', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB F"]().nodokumen']) !!}
    </div>
</div>

<!-- Tglmulai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tglmulai', 'Tahun/Bulan/Tanggal Mulai:') !!}
    {!! Form::text('tglmulai', null, ['class' => 'form-control','id'=>'tglmulai', 'id' => 'tglmulai-detilkonstruksi', 'data-bind' => 'value: viewModel.data["KIB F"]().tglmulai']) !!}
</div>

<!-- Statustanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('statustanah', 'Status Tanah:') !!}
    {!! Form::select('statustanah', [], null, ['class' => 'form-control', 'id' => 'statustanah-detilkonstruksi', 'data-bind' => 'value: viewModel.data["KIB F"]().statustanah']) !!}
</div>



<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB F"]().keterangan']) !!}
</div>


<!-- Submit Field -->
@if(!isset($notShowSubmit))
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('detilkonstruksis.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif


<script>
viewModel.jsLoaded.subscribe(() => {

    $('#luas-detilkonstruksi').mask("#.##0", {reverse: true});

    let googleMapKoordinatLokasiBangunan = null;
    let mapTanahBangunan = null;

    setTimeout(() => {
        googleMapKoordinatLokasiBangunan = new GoogleMapInput(document.getElementById('koordinatlokasi-detilkonstruksi'), {
            value: viewModel.data["KIB F"]().koordinatlokasi
        });

        mapTanahBangunan = new GoogleMapInput(document.getElementById('koordinattanah-detilkonstruksi'), {
            draw: true,
            drawOptions: [
                'Polygon',
            ],
            value: viewModel.data["KIB F"]().koordinattanah,
        })
    }, 2500)


    $('#statustanah-detilkonstruksi').select2({
        ajax: {
            url: "<?= url('api/statustanahs') ?>",
            dataType: 'json',
            processResults: function (data) {
            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
                results: data.data
            };
            }
        },
        theme: 'bootstrap' ,
    })



    $('#kodetanah-detilkonstruksi').select2({
        ajax: {
            url: "<?= url('api/detiltanahs') ?>",
            dataType: 'json',
            processResults: function (data) {
            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
                results: data.data
            };
            }
        },
        theme: 'bootstrap' ,
    })

    $('#kodetanah-detilkonstruksi').on('select2:select', function (e) {
            // Do something
        if ($('#kodetanah-detilkonstruksi').select2('data').length > -1) {
            // you can find this method in inventaris.ko.js
            viewModel.methods.SetAlamatHirearchy($('#kodetanah-detilkonstruksi').select2('data')[0], 'KIB F')
            document.getElementById('koordinatlokasi-detilkonstruksi').dispatchEvent(new Event('change'))
            document.getElementById('koordinattanah-detilkonstruksi').dispatchEvent(new Event('change'))
        }
    });

    new inlineDatepicker(document.getElementById('tgldokumen-detilkonstruksi'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });

    new inlineDatepicker(document.getElementById('tglmulai-detilkonstruksi'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });
})
</script>
