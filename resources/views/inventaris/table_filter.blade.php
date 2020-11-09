
<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('jenisbarangs_filter', 'Kelompok:') }}
            {{ Form::select('jenisbarangs_filter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('kodeobjek_filter', 'Objek:') }}
            {{ Form::select('kodeobjek_filter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('koderincianobjek_filter', 'Rincian Objek:') }}
            {{ Form::select('koderincianobjek_filter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('penggunafilter', 'Pengguna:') }}
            {{ Form::select('penggunafilter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('kuasapengguna_filter', 'Kuasa Pengguna:') }}
            {{ Form::select('kuasapengguna_filter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('subkuasa_filter', 'Sub Kuasa Pengguna:') }}
            {{ Form::select('subkuasa_filter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
    </div>
    <div class="row">
        @if (Route::getCurrentRoute()->getName() != 'inventaris.deleted')
            <div class="col-md-4">
                {{ Form::label('draft', 'Draft:') }}
                {{ Form::select('draft', \App\Models\BaseModel::$YesNoDs, 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
            </div>
            <div class="col-md-4">
                {{ Form::label('status_sensus', 'Status Sensus:') }}
                {{ Form::select('status_sensus',
                    \App\Helpers\Constant::$SENSUS_STATUS
                , 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
            </div>
        @endif
    </div>
</div>

<script>

    // Sembunyikan tombol konfirmasi jika bukan draft
    $(document).ready(function () {
        if ($('#draft').val() == "0") {
            $('.konfirmasi-draft').hide();
        } else {
            $('.konfirmasi-draft').show();
        }

        $('#draft').change(function () {
            if ($('#draft').val() == "0") {
                $('.konfirmasi-draft').hide();
            } else {
                $('.konfirmasi-draft').show();
            }
        });
    });

    viewModel.jsLoaded.subscribe(() => {
        $("#jenisbarangs_filter").select2({
            ajax: {
                url: "<?= url('api/jenisbarangs') ?>",
                dataType: 'json',
                data: function (params) {

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.nama
                            d.id = parseInt(d.kode)

                            return d
                        })
                    };
                }
            },
            theme: 'bootstrap' ,
        })

        $('#jenisbarangs_filter').on('change', function (e) {
            $("#kodeobjek_filter").val("").trigger("change")
        });

        $("#kodeobjek_filter").select2({
            ajax: {
                url: "<?= url('api/barangs') ?>",
                dataType: 'json',
                data: function (params) {
                    idInput = $(this)[0].id

                    params.kode_jenis = $("#jenisbarangs_filter").val()

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.nama_rek_aset
                            d.id = d.id
                            return d
                        })
                    };
                },
            },
            theme: 'bootstrap' ,
        })

        $('#kodeobjek_filter').on('change', function (e) {
            $("#koderincianobjek_filter").val("").trigger("change")
        });

        $("#koderincianobjek_filter").select2({
            ajax: {
                url: "<?= url('api/barangs') ?>",
                dataType: 'json',
                data: function (params) {
                    idInput = $(this)[0].id


                    params.kode_objek = $("#kodeobjek_filter").select2('data')[0].kode_objek
                    params.kode_jenis = $("#jenisbarangs_filter").val()

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.nama_rek_aset
                            d.id = d.id
                            return d
                        })
                    };
                },

            },
            theme: 'bootstrap' ,
        })

        $("#penggunafilter").select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
                dataType: 'json',
                data: function (params) {
                    params.level = "-1,0,1"

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.text
                            d.id = d.id
                            return d
                        })
                    };
                }
            },
            theme: 'bootstrap' ,
        })

        $('#penggunafilter').on('change', function (e) {
            $("#kuasapengguna_filter").val("").trigger("change")
        });

        $("#kuasapengguna_filter").select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
                dataType: 'json',
                data: function (params) {
                    params.level = "1,2"
                    params.pid = $("#penggunafilter").select2('data')[0].id
                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.text
                            d.id = d.id
                            return d
                        })
                    };
                },
            },
            theme: 'bootstrap' ,
        })

        $('#kuasapengguna_filter').on('change', function (e) {
            $("#subkuasa_filter").val("").trigger("change")
        });

        $("#subkuasa_filter").select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
                dataType: 'json',
                data: function (params) {
                    params.level = 2
                    params.pid = $("#kuasapengguna_filter").select2('data')[0].id

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.text
                            d.id = d.id
                            return d
                        })
                    };
                },

            },
            theme: 'bootstrap' ,
        })


        $("#organisasi_filter").select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>?pid=<?= Auth::user()->pid_organisasi ?>",
                dataType: 'json',
                data: function (params) {

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.text
                            d.id = d.id
                            return d
                        })
                    };
                },

            },
            theme: 'bootstrap' ,
        })

    })
</script>
