
<!-- Konstruksi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('konstruksi', 'Konstruksi:') !!}
    {!! Form::text('konstruksi', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB D"]().konstruksi']) !!}
</div>

<!-- Panjang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('panjang', 'Panjang:') !!}
    {!! Form::text('panjang', null, ['class' => 'form-control', 'id' => 'panjang-detiljalan', 'data-bind' => 'value: viewModel.data["KIB D"]().panjang']) !!}    
</div>

<!-- Lebar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lebar', 'Lebar:') !!}
    {!! Form::text('lebar', null, ['class' => 'form-control', 'id' => 'lebar-detiljalan' ,'data-bind' => 'value: viewModel.data["KIB D"]().lebar']) !!}
</div>

<!-- Luas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('luas', 'Luas:') !!}
    {!! Form::text('luas', null, ['class' => 'form-control', 'id' => 'luas-detiljalan' ,'data-bind' => 'value: viewModel.data["KIB D"]().luas']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alamat', 'Letak/Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB D"]().alamat']) !!}
</div>


<!-- Koordinatlokasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('koordinatlokasi', 'Koordinatlokasi:') !!}
    {!! Form::text('koordinatlokasi', null, ['class' => 'form-control', 'id' => 'koordinatlokasi-detiljalan', 'data-bind' => 'value: viewModel.data["KIB D"]().koordinatlokasi']) !!}
</div>

<!-- Koordinattanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('koordinattanah', 'Koordinattanah:') !!}
    {!! Form::text('koordinattanah', null, ['class' => 'form-control', 'id' => 'koordinattanah-detiljalan', 'data-bind' => 'value: viewModel.data["KIB D"]().koordinattanah']) !!}
</div>

<u class="col-md-12">Dokumen</u>

<div class="col-md-12">
    
    <!-- Tgldokumen Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('tgldokumen', 'Tanggal:') !!}
        {!! Form::text('tgldokumen', null, ['class' => 'form-control','id'=>'tgldokumen-detiljalan', 'data-bind' => 'value: viewModel.data["KIB D"]().tgldokumen']) !!}
    </div>

    <!-- Nodokumen Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('nodokumen', 'Nomor:') !!}
        {!! Form::text('nodokumen', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB D"]().nodokumen']) !!}
    </div>
</div>


<!-- Statustanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('statustanah', 'Status Tanah:') !!}
    {!! Form::select('statustanah', [], null, ['class' => 'form-control', 'id' => 'statustanah-detiljalan', 'data-bind' => 'value: viewModel.data["KIB D"]().statustanah']) !!}
</div>

<!-- Kodetanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kodetanah', 'Kode Tanah:') !!}
    {!! Form::select('kodetanah', [], null, ['class' => 'form-control', 'id' => 'kodetanah-detiljalan', 'data-bind' => 'value: viewModel.data["KIB D"]().kodetanah']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB D"]().keterangan']) !!}
</div>


<!-- Submit Field -->
@if(!isset($notShowSubmit))
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('detiljalans.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif

<script>
    viewModel.jsLoaded.subscribe(() => {

        const googleMapKoordinatLokasiJalan = new MapInput(document.getElementById('koordinatlokasi-detiljalan'), {})

        const mapTanahJalan = new MapInput(document.getElementById('koordinattanah-detiljalan'), {
            draw: true,
            drawOptions: [
                'Polygon',
                'LineString'
            ]
        })

        $('#panjang-detiljalan').mask("#.##0", {reverse: true});
        $('#lebar-detiljalan').mask("#.##0", {reverse: true});
        $('#luas-detiljalan').mask("#.##0", {reverse: true});

        new inlineDatepicker(document.getElementById('tgldokumen-detiljalan'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });

        $('#statustanah-detiljalan').select2({
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

        $('#kodetanah-detiljalan').select2({
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


      
    })
</script>