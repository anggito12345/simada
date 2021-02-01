<!-- Luas Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('luas', 'Luas Tanah:') !!}
    <div class="input-group">
        {!! Form::text('luas', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().luas']) !!}
        <div class="input-group-append">
            <span class="input-group-text text-danger" id="basic-addon2">Pemisah pecahan dengan titik (misal: 1.5)</span>
        </div>
    </div>
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('alamat', 'Letak/Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().alamat']) !!}
</div>

<!-- nilai_hub Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nilai_hub_kiba', 'Nilai HBU:') !!}
    {!! Form::number('nilai_hub_kiba', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().nilai_hub']) !!}
</div>

<!-- tipe Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('tipe_kiba', 'Tipe:') !!}
    {!! Form::text('tipe_kiba', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().tipe']) !!}
</div>


<!-- Koordinatlokasi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('koordinatlokasi', 'Koordinat lokasi:') !!}
    {!! Form::text('koordinatlokasi', null, ['class' => 'form-control koordinatlokasi', 'data-bind' => 'value: viewModel.data["KIB A"]().koordinatlokasi']) !!}
</div>

<!-- Koordinattanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('koordinattanah', 'Koordinat tanah:') !!}
    {!! Form::text('koordinattanah', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().koordinattanah']) !!}
</div>

<u class="col-md-12 no-padding">Status Tanah:</u>

<div class="col-md-12">
    <!-- Hak Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('hak', 'Hak:') !!}
        {!! Form::select('hak', \App\Models\BaseModel::$hakDs, null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().hak']) !!}
    </div>

    <!-- Status Sertifikat Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('status_sertifikat', 'Status Sertifikat:') !!}
        {!! Form::select('status_sertifikat', \App\Models\BaseModel::$sertifikatDs, null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().status_sertifikat']) !!}
    </div>

    <!-- Tgl Sertifikat Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('tgl_sertifikat', 'Tgl Sertifikat:') !!}
        {!! Form::text('tgl_sertifikat', null, ['class' => 'form-control','id'=>'tgl_sertifikat', 'data-bind' => 'value: viewModel.data["KIB A"]().tgl_sertifikat']) !!}
    </div>

    <!-- Nama Sertifikat Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('nomor_sertifikat', 'Nomor Sertifikat:') !!}
        {!! Form::text('nomor_sertifikat', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().nomor_sertifikat']) !!}
    </div>

    <!-- Penggunaan Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('penggunaan', 'Penggunaan:') !!}
        {!! Form::select('penggunaan', [], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().penggunaan']) !!}
    </div>

    <!-- Keterangan Field -->
    <div class="form-group col-sm-6 row">
        {!! Form::label('keterangan', 'Keterangan:') !!}
        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().keterangan']) !!}
    </div>
</div>




<!-- Submit Field -->
@if(!isset($notShowSubmit))
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('detiltanahs.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif


<script type="text/javascript">

    $('#luas').mask("#.##0", {reverse: true});

    viewModel.jsLoaded.subscribe((newVal) => {
        // document is ready. Do your stuff here
        let googleMapKoordinatLokasi = null;
        let mapTanah = null;

        setTimeout(() => {
            googleMapKoordinatLokasi = new GoogleMapInput(document.getElementById('koordinatlokasi'), {
                value: viewModel.data["KIB A"]().koordinatlokasi
            });

            mapTanah = new GoogleMapInput(document.getElementById('koordinattanah'), {
                referFocus: $('#koordinatlokasi'),
                draw: true,
                drawOptions: [
                    'Polygon'
                ],
                value: viewModel.data["KIB A"]().koordinattanah,
            })
        }, 2500)

        new inlineDatepicker(document.getElementById('tgl_sertifikat'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });

        $('input[tipe]')

        $('#penggunaan').select2({
            ajax: {
                url: "<?= url('api/pengunaans') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,
                    }
                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data
                    };
                }
            },
            theme: 'bootstrap' ,
        })



    })
</script>

