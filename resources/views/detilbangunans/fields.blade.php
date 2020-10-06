<!-- nilai_hub Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nilai_hub_kibc', 'Nilai Hub:') !!}
    {!! Form::number('nilai_hub_kibc', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().nilai_hub']) !!}
</div>

<!-- tipe Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('tipe_kibc', 'Tipe:') !!}
    {!! Form::text('tipe_kibc', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().tipe']) !!}
</div>

<!-- Konstruksi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('konstruksi', 'Konstruksi:') !!}
    {!! Form::select('konstruksi', \App\Models\BaseModel::$konstruksiDs, null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().konstruksi']) !!}
</div>


<u class="col-md-12 no-padding">Kontruksi Bangunan</u>

<div class="col-md-12">

    <!-- Bertingkat Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('bertingkat', 'Bertingkat:') !!}&nbsp;
        <div class="radio">
            {!! Form::radio('bertingkat', 1, isset($detilbangunan) ? $detilbangunan->bertingkat == 1 : false, ['data-bind' => 'checked: viewModel.data["KIB C"]().bertingkat']) !!} Ya
            {!! Form::radio('bertingkat', 0, isset($detilbangunan) ? $detilbangunan->bertingkat == 0 : false, ['data-bind' => 'checked: viewModel.data["KIB C"]().bertingkat']) !!} Tidak
        </div>
    </div>

    <!-- Beton Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('beton', 'Beton:') !!}&nbsp;
        <div class="radio">
            {!! Form::radio('beton', 1, isset($detilbangunan) ? $detilbangunan->beton == 1 : false, ['data-bind' => 'checked: viewModel.data["KIB C"]().beton']) !!} Ya
            {!! Form::radio('beton', 0, isset($detilbangunan) ? $detilbangunan->beton == 0 : false, ['data-bind' => 'checked: viewModel.data["KIB C"]().beton']) !!} Tidak
        </div>
    </div>
</div>



<!-- Luastanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('luastanah', 'Luas Total Lantai:') !!}
    {!! Form::number('luastanah', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().luastanah']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('alamat', 'Letak/Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().alamat']) !!}
</div>

<!-- Luasbangunan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('luasbangunan', 'Luas Bangunan:') !!}
    {!! Form::number('luasbangunan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().luasbangunan']) !!}
</div>


<!-- Koordinatlokasi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('koordinatlokasi', 'Koordinat Lokasi:') !!}
    {!! Form::text('koordinatlokasi', null, ['class' => 'form-control', 'id' => 'koordinatlokasi-detilbangunan', 'data-bind' => 'value: viewModel.data["KIB C"]().koordinatlokasi']) !!}
</div>

<!-- Koordinattanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('koordinattanah', 'Koordinat Tanah:') !!}
    {!! Form::text('koordinattanah', null, ['class' => 'form-control', 'id' => 'koordinattanah-detilbangunan', 'data-bind' => 'value: viewModel.data["KIB C"]().koordinattanah']) !!}
</div>


<script type="text/javascript">
    viewModel.jsLoaded.subscribe(() => {

        let googleMapKoordinatLokasiBangunan = null;
        let mapTanahBangunan = null;

        setTimeout(() => {
            googleMapKoordinatLokasiBangunan = new GoogleMapInput(document.getElementById('koordinatlokasi-detilbangunan'), {
                value: viewModel.data["KIB C"]().koordinatlokasi
            });

            mapTanahBangunan = new GoogleMapInput(document.getElementById('koordinattanah-detilbangunan'), {
                draw: true,
                drawOptions: [
                    'Polygon',
                ],
                value: viewModel.data["KIB C"]().koordinattanah,
            })
        }, 2500)

        $('#statustanah').select2({
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

        $('#kodetanah').select2({
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


        new inlineDatepicker(document.getElementById('tgldokumen'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });
    })
</script>


<u class="col-md-12 no-padding">Dokumen</u>

<div class="col-md-12">
    <!-- Tgldokumen Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('tgldokumen', 'Tanggal:') !!}
        {!! Form::text('tgldokumen', null, ['class' => 'form-control','id'=>'tgldokumen', 'data-bind' => 'value: viewModel.data["KIB C"]().tgldokumen']) !!}
    </div>

    <!-- Nodokumen Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('nodokumen', 'Nomor:') !!}
        {!! Form::text('nodokumen', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().nodokumen']) !!}
    </div>
</div>

<!-- Statustanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('statustanah', 'Status Tanah:') !!}
    {!! Form::select('statustanah', [], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().statustanah']) !!}
</div>

<!-- Kodetanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('kodetanah', 'Kode Tanah:') !!}
    {!! Form::select('kodetanah', [], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().kodetanah']) !!}
</div>

<!-- Dokumen Field -->
<!-- <div class="form-group col-sm-6 row">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::text('dokumen', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Keterangan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB C"]().keterangan']) !!}
</div>

<!-- Foto Field -->
<!-- <div class="form-group col-sm-6 row">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::text('foto', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
@if(!isset($notShowSubmit))
    <div class="form-group col-sm-12">
        {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
        <a href="{!! route('detilbangunans.index') !!}" class="btn btn-default">Batal</a>
    </div>
@endif
