
<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('jenisbarangs_filter', 'Jenis Barang:') }}
            {{ Form::select('jenisbarangs_filter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('kodeobjek_filter', 'Kelompok Barang:') }}
            {{ Form::select('kodeobjek_filter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('koderincianobjek_filter', 'Sub Kelompok Barang:') }}
            {{ Form::select('koderincianobjek_filter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>        
    </div>    
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('organisasi_filter', 'Organisasi:') }}
            {{ Form::select('organisasi_filter', [], 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
        <div class="col-md-4">
            {{ Form::label('draft', 'Draft:') }}
            {{ Form::select('draft', \App\Models\BaseModel::$YesNoDs, 0, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.changeRefreshGrid()']) }}
        </div>
    </div>
</div>

<script>
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

        // $('#koderincianobjek_filter').on('change', function (e) {
        //     $("#kodesubrincianobjek_filter").val("").trigger("change")
        // });

        // $("#kodesubrincianobjek_filter").select2({
        //     ajax: {                                
        //         url: "<?= url('api/barangs') ?>",
        //         dataType: 'json',
        //         data: function (params) {
        //             idInput = $(this)[0].id
        //             params.kode_objek = $("#kodeobjek_filter").select2('data')[0].kode_objek 
        //             params.kode_jenis = $("#jenisbarangs_filter").val() 
        //             params.kode_rincian_objek = $("#koderincianobjek_filter").select2('data')[0].kode_rincian_objek 

        //             return params;
        //         },
        //         processResults: function (data) {
        //             // Transforms the top-level key of the response object from 'items' to 'results'
        //             return {
        //                 results: data.data.map((d) => {
        //                     d.text = d.nama_rek_aset
        //                     return d
        //                 })
        //             };
        //         }
        //     },
        //     theme: 'bootstrap' ,
        // })
    })
</script>