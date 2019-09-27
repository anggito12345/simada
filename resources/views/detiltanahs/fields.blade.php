<!-- Luas Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('luas', 'Luas Tanah:') !!}
    <div class="input-group">
        {!! Form::number('luas', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().luas']) !!}
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

<!-- Idkota Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('idkota', __('field.idkota')) !!}
    {!! Form::select('idkota',[], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().idkota']) !!}
</div>

<!-- Idkecamatan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('idkecamatan', __('field.idkecamatan')) !!}
    {!! Form::select('idkecamatan', [], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().idkecamatan']) !!}
</div>

<!-- Idkelurahan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('idkelurahan', __('field.idkelurahan')) !!}
    {!! Form::select('idkelurahan', [], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().idkelurahan']) !!}
</div>

<!-- Koordinatlokasi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('koordinatlokasi', 'Koordinat lokasi:') !!}
    {!! Form::text('koordinatlokasi', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().koordinatlokasi']) !!}
</div>

<!-- Koordinattanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('koordinattanah', 'Koordinat tanah:') !!}
    {!! Form::text('koordinattanah', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().koordinattanah']) !!}
</div>

<div class="box box-primary">
    <div class="box-header bg-blue">
        Status Tanah:
    </div>
    <div class="box-body">
        <!-- Hak Field -->
        <div class="form-group col-sm-6 row">
            {!! Form::label('hak', 'Hak:') !!}
            {!! Form::text('hak', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().hak']) !!}
        </div>

        <!-- Status Sertifikat Field -->
        <div class="form-group col-sm-6 row">
            {!! Form::label('status_sertifikat', 'Status Sertifikat:') !!}
            {!! Form::select('status_sertifikat',[
                'Belum Sertifikat' => 'Belum Sertifikat',
                'Sudah Sertifikat' => 'Sudah Sertifikat',
            ], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().status_sertifikat']) !!}
        </div>

        <!-- Tgl Sertifikat Field -->
        <div class="form-group col-sm-6 row">
            {!! Form::label('tgl_sertifikat', 'Tgl Sertifikat:') !!}
            {!! Form::text('tgl_sertifikat', null, ['class' => 'form-control','id'=>'tgl_sertifikat', 'data-bind' => 'value: viewModel.data["KIB A"]().tgl_sertifikat']) !!}
        </div>

        <!-- Nama Sertifikat Field -->
        <div class="form-group col-sm-6 row">
            {!! Form::label('nama_sertifikat', 'Nomor Sertifikat:') !!}
            {!! Form::text('nama_sertifikat', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().nama_sertifikat']) !!}
        </div>

        <!-- Penggunaan Field -->
        <div class="form-group col-sm-6 row">
            {!! Form::label('penggunaan', 'Penggunaan:') !!}
            {!! Form::text('penggunaan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().penggunaan']) !!}
        </div>

        <!-- Keterangan Field -->
        <div class="form-group col-sm-6 row">
            {!! Form::label('keterangan', 'Keterangan:') !!}
            {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB A"]().keterangan']) !!}
        </div>

    </div>
</div>




<!-- Submit Field -->
@if(!isset($notShowSubmit))
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('detiltanahs.index') !!}" class="btn btn-default">Cancel</a>
</div>
@endif


<script type="text/javascript"> 
    
    viewModel.jsLoaded.subscribe((newVal) => {    
        // document is ready. Do your stuff here
        const googleMapKoordinatLokasi = new GoogleMapInput(document.getElementById('koordinatlokasi'), {})

        const mapTanah = new GoogleMapInput(document.getElementById('koordinattanah'), {
            draw: true,
            drawOptions: [
                'Polygon'
            ]
        })

        new inlineDatepicker(document.getElementById('tgl_sertifikat'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });

        $('#idkota').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,                                           
                        addWhere: [
                            "jenis = 'Kota'"
                        ]
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


        $('#idkota').on('change', function (e) {
            $("#idkecamatan").val("").trigger("change")
        });


        $('#idkecamatan').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,                                           
                        addWhere: [
                            "jenis = 'Kecamatan'",
                            "pid = " + $("#idkota").val()
                        ]
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

        $('#idkecamatan').on('change', function (e) {
            $("#idkelurahan").val("").trigger("change")
        });

        $('#idkelurahan').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,                                           
                        addWhere: [
                            "jenis = 'Kelurahan/Desa'",
                            "pid = " + $("#idkecamatan").val()
                        ]
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


        $('#tgl_sertifikat').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('<?=  "#pidinventaris-".$idPostfix ?>').select2({
            ajax: {
                url: "<?= url('api/inventaris') ?>",
                dataType: 'json',
                processResults: function (data) {

                    let options = {
                        id: "-",
                        text: "<div class='text-gray'>Tambah Inventaris Baru</div>"
                    }
                    let id = '<?=  "#pidinventaris-".$idPostfix ?>'
                    if (id.indexOf("non-ajax") > -1) {
                        data.data.unshift(options)
                    }                    
                    return {
                        results: data.data
                    };
                }
            },
            templateResult: function (d) {                 
                return $("<span>"+d.text+"</span>"); 
            },
            templateSelection: function (d) { return $("<span>"+d.text+"</span>"); },
            theme: 'bootstrap' ,
        })

        $('<?=  "#pidinventaris-".$idPostfix ?>').on('select2:select', function (e) {
            var data = e.params.data;
            if (data.id == "-") {
                $("#modal-inventaris").modal("show")
                $('<?=  "#pidinventaris-".$idPostfix ?>').val("").trigger("change")
            }
        });
    })
</script>

