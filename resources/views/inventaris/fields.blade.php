
<!-- <div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidbarang', __("field.pidbarang")) !!}
    {!! Form::select('pidbarang', [], null, \App\Models\BaseModel::generateValidation('pidbarang', \App\Models\inventaris::$rules, ['class' => 'form-control form-control-lg'])) !!}
</div> -->

<div class="form-group col-sm-6 no-padding <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?>">
    {!! Form::label('pidbarang', 'Barang') !!}
    <div class="row">
        <div class="col-md-4">
            {!! Form::text('kodebarang', null, ['class' => 'form-control','style' => 'margin:1px -15px 0 0px; float:left', 'readonly' => true]) !!}
        </div>
        <div class="col-md-8">
            {!! Form::text('pidbarang', null, ['class' => 'form-control baranglookup', 'id' => 'baranglookup']) !!}
        </div>
    </div>
</div>

<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    <!-- Tahun Perolehan -->
    {!! Form::label('tahun_perolehan', 'Tahun Perolehan') !!} <span class="text-danger">*</span>
    <div class="input-group">

        {!! Form::text('tahun_perolehan', null, ['class' => 'form-control', 'maxlength' => 4, 'required' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text text-danger" id="basic-addon2">4 digit(mis: 2018)</span>
        </div>
    </div>
</div>

<!-- Harga Satuan Field -->
@if(isset($inventaris))
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('harga_satuan', 'Harga Satuan:') !!} <span class="text-danger">*</span>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
        </div>
        {!! Form::text('harga_satuan', null, ['class' => 'form-control', 'required' => true, "disabled"]) !!}
    </div>
</div>
@else
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('harga_satuan', 'Harga Satuan:') !!} <span class="text-danger">*</span>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
        </div>
        {!! Form::text('harga_satuan', null, ['class' => 'form-control', 'required' => true]) !!}
    </div>
</div>
@endif

<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpozs($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    <div class="row">
        <div class="col-md-6">
            @if(isset($inventaris))
            {!! Form::label('jumlah', 'Jumlah') !!} <span class="text-danger">*</span>
            <div class="input-group col-md-12 no-padding mr-2">
                {!! Form::number('jumlah',  (isset($inventaris) ? $inventaris->jumlah : 1 ), ['class' => 'form-control', 'max' => 9999999, 'required' => true, "disabled"]) !!}
            </div>
            @else
            {!! Form::label('jumlah', 'Jumlah') !!} <span class="text-danger">*</span>
            <div class="input-group col-md-12 no-padding mr-2">
                {!! Form::number('jumlah',  (isset($inventaris) ? $inventaris->jumlah : 1 ), ['class' => 'form-control', 'max' => 9999999, 'required' => true]) !!}
            </div>
            @endif
        </div>
        <div class="col-md-6">
            {!! Form::label('satuan', 'Satuan') !!} <span class="text-danger">*</span>
            <div class="input-group col-md-12 no-padding">
                {!! Form::select('satuan', [], null, ['class' => 'form-control', 'required' => true]) !!}
            </div>
        </div>
    </div>
</div>

<!-- nama populer Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('nama_populer',  __('field.nama_populer').':') !!}
    {!! Form::text('nama_populer', null, ['class' => 'form-control nama_populer','id'=>'nama_populer']) !!}
</div>

<!-- Perolehan Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('perolehan', __('field.perolehan')) !!} <span class="text-danger">*</span>
    {!! Form::select('perolehan', \App\Models\BaseModel::$perolehanDs , null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Kondisi Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kondisi', 'Kondisi:') !!} <span class="text-danger">*</span>
    {!! Form::select('kondisi',\App\Models\BaseModel::$kondisiDs, null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Tgl Sensus Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('tgl_dibukukan',  __('field.tgl_dibukukan').':') !!}
    {!! Form::text('tgl_dibukukan', null, ['class' => 'form-control tgl_dibukukan','id'=>'tgl_dibukukan']) !!}
</div>

<!-- Kode Ruang Field -->
<!-- <div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_ruang',  __('field.kode_ruang').':') !!}
    {!! Form::text('kode_ruang', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_gedung',  __('field.kode_gedung').':') !!}
    {!! Form::text('kode_gedung', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('penanggung_jawab',  __('field.penanggung_jawab').':') !!}
    {!! Form::text('penanggung_jawab', null, ['class' => 'form-control']) !!}
</div>-->

<!-- Tgl Sensus Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('tgl_sensus', 'Tgl Sensus:') !!}
    {!! Form::text('tgl_sensus', null, ['class' => 'form-control tgl_sensus','id'=>'tgl_sensus']) !!}
</div>

<!-- Provinsi Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('alamat_propinsi', 'Provinsi:') !!} <span class="text-danger">*</span>
    {!! Form::select('alamat_propinsi', [] , 32, ['class' => 'form-control']) !!}
</div>

<!-- Kota Kabupaten Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('alamat_kota', 'Kota/Kabupaten:') !!} <span class="text-danger">*</span>
    {!! Form::select('alamat_kota', [] , "", ['class' => 'form-control']) !!}
</div>

<!-- Kecamatan Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('alamat_kecamatan', 'Kecamatan:') !!} <span class="text-danger">*</span>
    {!! Form::select('alamat_kecamatan', [] , "", ['class' => 'form-control']) !!}
</div>
<!-- Kelurahan/Desa Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('alamat_kelurahan', 'Kelurahan/Desa:') !!} <span class="text-danger">*</span>
    {!! Form::select('alamat_kelurahan', [] , "", ['class' => 'form-control']) !!}
</div>

<!-- pid opd Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidopd', 'Pengguna Barang') !!} <span class="text-danger">*</span>
    {!! Form::select('pidopd', [] , "", ['class' => 'form-control']) !!}
</div>

<!-- pid opd cabang Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidopd_cabang', 'Kuasa Pengguna Barang') !!}
    {!! Form::select('pidopd_cabang', [] , null, ['class' => 'form-control']) !!}
</div>

<!-- pid upt Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidupt', 'Sub Kuasa Pengguna Barang') !!}
    {!! Form::select('pidupt', [] , null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Lokasi Field -->
<!--<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_lokasi', 'Kode Lokasi:') !!}
    {!! Form::text('kode_lokasi', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
</div>-->

<div class="form-group col-sm-12 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-12' : 'col-md-12' ?> row">
    {!! Form::file('dokumen', ['class' => 'form-control','id'=>'dokumen', 'name' => 'dummy', 'multiple' => true]) !!}
</div>

<div class="form-group col-sm-12 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-12' : 'col-md-12' ?> row">
    {!! Form::file('foto', ['class' => 'form-control','id'=>'foto', 'name' => 'dummy', 'multiple' => true]) !!}
</div>

<!-- Pidlokasi Field -->
<!-- <div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidlokasi',__("field.pidlokasi")) !!}
    {!! Form::select('pidlokasi',[], null, ['class' => 'form-control form-control-lg']) !!}
</div> -->

@section(!isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'scripts' : 'scripts_2')

    @if (isset($_GET['is_ubah_satuan']))
    <script>
        let isUbahSatuan = "{!! $_GET['is_ubah_satuan'] !!}"
    </script>
    @else
    <script>
        let isUbahSatuan = null
    </script>
    @endif

    @if (isset($_GET['id_sensus']))
    <script>
        let isSensus = "{!! $_GET['id_sensus'] !!}"
    </script>
    @else
    <script>
        let isSensus = null
    </script>
    @endif


    <script type="text/javascript">
        const funcBarangSelect = function(d) {
            let appendKode = ""
            if (d.kode_akun != "" && d.kode_akun != null) {
                appendKode += d.kode_akun
            }

            if (d.kode_kelompok != "" && d.kode_kelompok != null) {
                appendKode += "." + d.kode_kelompok
            }

            if (d.kode_jenis != "" && d.kode_jenis != null) {
                appendKode += "." + d.kode_jenis
            }

            if (d.kode_objek != "" && d.kode_objek != null) {
                appendKode += "." + d.kode_objek
            }

            if (d.kode_rincian_objek != "" && d.kode_rincian_objek != null) {
                appendKode += "." + d.kode_rincian_objek
            }

            if (d.kode_sub_rincian_objek != "" && d.kode_sub_rincian_objek != null) {
                appendKode += "." + d.kode_sub_rincian_objek
            }

            if (d.kode_sub_sub_rincian_objek != "" && d.kode_sub_sub_rincian_objek != null) {
                appendKode += "." + d.kode_sub_sub_rincian_objek
            }

            $("[name=kodebarang]").val(appendKode)

            __ajax({
                method: 'GET',
                url: `<?= url('api/jenisbarangsget/getbykode') ?>/${d.kode_jenis}`,
                dataType: 'json'
            }).then((response) => {
                viewModel.data.tipeKib(`KIB ${response.kelompok_kib}`);
            })
        }

        const funcGetDokumenFileList = () => {
            __ajax({
                method: 'GET',
                url: "<?= url('api/system_uploads') ?>",
                data: {
                    jenis: 'dokumen',
                    foreign_field: 'id',
                    foreign_id: <?= isset($inventaris) ? $inventaris->id : 'null' ?>,
                    foreign_table: 'inventaris',
                },
            }).then((files) => {
                fileGallery.fileList(files)
            })
        }


        const funcGetFotoFileList = () => {
            __ajax({
                method: 'GET',
                url: "<?= url('api/system_uploads') ?>",
                data: {
                    jenis: 'foto',
                    foreign_field: 'id',
                    foreign_id: <?= isset($inventaris) ? $inventaris->id : 'null' ?>,
                    foreign_table: 'inventaris'
                },
            }).then((files) => {
                foto.fileList(files)
            })
        }

        $(".baranglookup").LookupTable({
            DataTable: {
                ajax: {
                    url: $("[base-path]").val() + "/api/barangs/get",
                    dataSrc: 'data',
                    data: (d) => {
                        return d
                    }
                },
                columns: [
                    { data: 'nama_rek_aset', title: 'Nama Barang' },

                ],
                "dom": `<'row'<'col-sm-6'l><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'table-responsive'<'col-sm-5'i><'col-sm-7'p>>>`,
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "searching": false,
                responsive: true,
                custom: {
                    typeInput: 'radio',
                    textField: 'nama_rek_aset',
                    valueField: 'id',
                    autoClose: false,
                    filters: [
                        { name: "kode_jenis", type: "select2", title: "Bidang" , select2config: {
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
                            custom: {
                                valueField: "kode",
                                change: (obj) => {
                                    let idInput = obj.currentTarget.id
                                    $("#" + idInput.replace('kode_jenis', 'kode_objek')).val("").trigger('change')
                                }
                            }
                        }},
                        { name: "kode_objek", type: "select2", title: "Kelompok" , select2config: {
                            ajax: {
                                url: "<?= url('api/barangs') ?>",
                                dataType: 'json',
                                data: function (params) {
                                    idInput = $(this)[0].id

                                    params.kode_jenis = $("#" + idInput.replace('kode_objek', 'kode_jenis')).val()

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
                            custom: {
                                valueField: "kode_objek",
                                change: (obj) => {
                                    let idInput = obj.currentTarget.id
                                    $("#" + idInput.replace('kode_objek', 'kode_rincian_objek')).val("").trigger('change')
                                }
                            }
                        }},
                        { name: "kode_rincian_objek", type: "select2", title: "Sub Kelompok" , select2config: {
                            ajax: {
                                url: "<?= url('api/barangs') ?>",
                                dataType: 'json',
                                data: function (params) {
                                    idInput = $(this)[0].id


                                    params.kode_objek = $("#" + idInput.replace('kode_rincian_objek', 'kode_objek')).select2('data')[0].kode_objek
                                    params.kode_jenis = $("#" + idInput.replace('kode_rincian_objek', 'kode_jenis')).val()

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
                            custom: {
                                valueField: "kode_rincian_objek",
                                change: (obj) => {
                                    let idInput = obj.currentTarget.id
                                    $("#" + idInput.replace('kode_rincian_objek', 'kode_sub_rincian_objek')).val("").trigger('change')
                                }
                            }
                        }},
                        { name: "kode_sub_rincian_objek", type: "select2", title: "Sub Sub Kelompok" , select2config: {
                            ajax: {
                                url: "<?= url('api/barangs') ?>",
                                dataType: 'json',
                                data: function (params) {
                                    idInput = $(this)[0].id
                                    params.kode_objek = $("#" + idInput.replace('kode_sub_rincian_objek', 'kode_objek')).select2('data')[0].kode_objek
                                    params.kode_jenis = $("#" + idInput.replace('kode_sub_rincian_objek', 'kode_jenis')).val()
                                    params.kode_rincian_objek = $("#" + idInput.replace('kode_sub_rincian_objek', 'kode_rincian_objek')).select2('data')[0].kode_rincian_objek

                                    return params;
                                },
                                processResults: function (data) {
                                    // Transforms the top-level key of the response object from 'items' to 'results'
                                    return {
                                        results: data.data.map((d) => {
                                            d.text = d.nama_rek_aset
                                            return d
                                        })
                                    };
                                }
                            },
                            theme: 'bootstrap' ,
                            custom: {
                                valueField: "kode_sub_rincian_objek"
                            }
                        }},
                        { name: "nama_rek_aset", type:"text", title: "Ketik nama barang/jenis barang yang akan dicari"},
                    ],
                    select: funcBarangSelect
                }
            }
        })

        $('#alamat_propinsi').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,
                        addWhere: [
                            "jenis = '0'"
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

        App.Helpers.defaultSelect2(
            $('#alamat_propinsi'),
            "<?= url('api/alamats/32') ?>",
            'id',
            'nama',
            () => {
                $('#alamat_propinsi').val("32").trigger('change');
        });


        $('#alamat_propinsi').on('change', function (e) {
            const selectedItem = $('#alamat_propinsi').select2("data")
            if (selectedItem.length > 0 && selectedItem[0].latitude != "" && selectedItem[0].longitude && viewModel.data[viewModel.data.tipeKib()]().koordinatlokasi == "") {
                viewModel.data[viewModel.data.tipeKib()]().koordinatlokasi = selectedItem[0].longitude + "," + selectedItem[0].latitude
                $('.koordinatlokasi').val(selectedItem[0].longitude + "," + selectedItem[0].latitude)
            }
            $("#alamat_kota").val("").trigger("change")
        });


        $('#alamat_kota').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,
                        addWhere: [
                            "jenis = '1'",
                            "pid = " + $("#alamat_propinsi").val()
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

        $('#alamat_kota').on('change', function (e) {
            const selectedItem = $('#alamat_kota').select2("data")
            if (selectedItem.length > 0 && selectedItem[0].latitude != "" && selectedItem[0].longitude && viewModel.data[viewModel.data.tipeKib()]().koordinatlokasi == "") {
                viewModel.data[viewModel.data.tipeKib()]().koordinatlokasi = selectedItem[0].longitude + "," + selectedItem[0].latitude
                $('.koordinatlokasi').val(selectedItem[0].longitude + "," + selectedItem[0].latitude)
            }
            $("#alamat_kecamatan").val("").trigger("change")
        });


        $('#alamat_kecamatan').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,
                        addWhere: [
                            "jenis = '2'",
                            "pid = " + $("#alamat_kota").val()
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

        $('#alamat_kecamatan').on('change', function (e) {
            const selectedItem = $('#alamat_kecamatan').select2("data")
            if (selectedItem.length > 0 && selectedItem[0].latitude != "" && selectedItem[0].longitude && viewModel.data[viewModel.data.tipeKib()]().koordinatlokasi == "") {
                viewModel.data[viewModel.data.tipeKib()]().koordinatlokasi = selectedItem[0].longitude + "," + selectedItem[0].latitude
                $('.koordinatlokasi').val(selectedItem[0].longitude + "," + selectedItem[0].latitude)
            }
            $("#alamat_kelurahan").val("").trigger("change")
        });


        $('#alamat_kelurahan').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,
                        addWhere: [
                            "jenis = '3'",
                            "pid = " + $("#alamat_kecamatan").val()
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

        $('#alamat_kelurahan').on('change', function (e) {
            const selectedItem = $('#alamat_kelurahan').select2("data")
            if (selectedItem.length > 0 && selectedItem[0].latitude != "" && selectedItem[0].longitude != "" && viewModel.data[viewModel.data.tipeKib()]().koordinatlokasi == "") {
                
                viewModel.data[viewModel.data.tipeKib()]().koordinatlokasi = selectedItem[0].longitude + "," + selectedItem[0].latitude
                $('.koordinatlokasi').val(selectedItem[0].longitude + "," + selectedItem[0].latitude)
            }

            console.log($('#alamat_kelurahan').select2("data"), viewModel.data[viewModel.data.tipeKib()]().koordinatlokasi)
        });

        $('#harga_satuan').mask("#.##0,00", {reverse: true});

        $('#tahun_perolehan').mask("0000");

        $('#tahun_perolehan').change((d) => {
            if (parseInt($("#tahun_perolehan").val()) > parseInt(new Date().getFullYear())) {
                $("#tahun_perolehan").val(new Date().getFullYear())
                return;
            }

            if (isNaN(parseInt(new Date().getFullYear()))) {
                swal.fire({
                    type: 'error',
                    text: 'Tahun perolehan salah!'
                })

                $("#tahun_perolehan").val('')
                return;
            }

            let tglDibukukan = $('#tgl_dibukukan').val()

            $($("#tgl_dibukukan").parent().find('select')[0]).val(parseInt($("#tahun_perolehan").val())).trigger('change')

            tglDibukukanInline.creatingResult()
        })

        $('#pidbarang').select2({
            ajax: {
                url: "<?= url('api/barangs') ?>",
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

        $('#pidopd').select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
                dataType: 'json',
                data: function(d) {
                    d.level = 0
                    return d
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

        $('#pidopd').on('change', function (e) {
            $("#pidopd_cabang").val("").trigger("change")
        });

        $('#pidopd_cabang').select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
                dataType: 'json',
                data: function(d) {
                    d.level = 1
                    d.pid = $('#pidopd').select2('val')
                    return d
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

        $('#pidopd_cabang').on('change', function (e) {
            $("#pidupt").val("").trigger("change")
        });

        $('#pidupt').select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
                dataType: 'json',
                data: function(d) {
                    d.level = 2
                    d.pid = $('#pidopd_cabang').select2('val')
                    return d
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

        $('#pidlokasi').select2({
            ajax: {
                url: "<?= url('api/lokasis') ?>",
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


        $('#satuan').select2({
            ajax: {
                url: "<?= url('api/satuanbarangs') ?>",
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

        const tglDibukukanInline = new inlineDatepicker(document.getElementsByClassName('tgl_dibukukan'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
            readonly: {
                yearPicker: true
            }
        });

        new inlineDatepicker(document.getElementsByClassName('tgl_sensus'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });

        var fileGallery = new FileGallery(document.getElementById('dokumen'), {
            title: 'File Dokumen',
            maxSize: 25000000,
            onDelete: () => {
                return new Promise((resolve, reject) => {
                    let checkIfIdExist = fileGallery.checkedRow().filter((d) => {
                        return d.id != undefined
                    })
                    if (checkIfIdExist.length < 1) {
                        resolve(true)
                        return
                    }
                    __ajax({
                        method: 'DELETE',
                        url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                                return d.id
                            }),
                    }).then((d) => {
                        resolve(true)
                        funcGetDokumenFileList()
                    })
                })
            }
        })

        var foto = new FileGallery(document.getElementById('foto'), {
            title: 'Media',
            maxSize: 1000000000,
            onDelete: () => {
                return new Promise((resolve, reject) => {
                    let checkIfIdExist = foto.checkedRow().filter((d) => {
                        return d.id != undefined
                    })
                    if (checkIfIdExist.length < 1) {
                        resolve(true)
                        return
                    }
                    __ajax({
                        method: 'DELETE',
                        url: "<?= url('api/system_uploads') ?>/" + checkIfIdExist.map((d) => {
                                return d.id
                            }),
                    }).then((d) => {
                        resolve(true)
                        funcGetDokumenFileList()
                    })
                })
            }
        })

        // ... please put any starter code here
        funcGetFotoFileList()
        funcGetDokumenFileList()

        const onSave = (isDraft) => {
            Swal.fire({
                    title: 'Anda yakin?',
                    html: `Data akan tersimpan <b>${isDraft ? "" : "tidak"} sebagai draft</b>`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if (result.value) {
                        let formData = new FormData($('#form-inventaris')[0])

                        formData.append(`draft`, isDraft ? '1' : '')
                        formData.append(`id_sensus`, isSensus)
                        formData.append(`is_ubah_satuan`, isUbahSatuan)

                        for (let index =0 ; index < fileGallery.fileList().length; index ++) {
                            const d = fileGallery.fileList()[index]
                            if (d.rawFile) {
                                formData.append(`dokumen[${index}]`, d.rawFile)
                            } else {
                                formData.append(`dokumen[${index}]`, false)
                            }

                            let keys = Object.keys(d)

                            keys.forEach((key) => {
                                if (key == 'rawFile') {
                                    return
                                }
                                formData.append(`dokumen_metadata_${key}[${index}]`, d[key])
                            })

                            formData.append(`dokumen_metadata_id_inventaris[${index}]`, <?= isset($inventaris) ? $inventaris->id: 'null' ?>)
                        }

                        foto.fileList().forEach((d, index) => {
                            if (d.rawFile) {
                                formData.append(`foto[${index}]`, d.rawFile)
                            } else {
                                formData.append(`foto[${index}]`, false)
                            }

                            let keys = Object.keys(d)

                            keys.forEach((key) => {
                                if (key == 'rawFile') {
                                    return
                                }
                                formData.append(`foto_metadata_${key}[${index}]`, d[key])
                            })



                            formData.append(`foto_metadata_id_inventaris[${index}]`, <?= isset($inventaris) ? $inventaris->id: 'null' ?>)

                            return d.rawFile
                        })

                        formData.append(`kib`, JSON.stringify(viewModel.data[viewModel.data.tipeKib()]()))
                        formData.append(`kode_barang`, $("[name=kodebarang]").val())
                        //formData.append(`kode_lokasi`, $('#kode_lokasi').val())
                        formData.append('tipe_kib', viewModel.data.tipeKib().replace(/KIB /g,""))

                        if (!isNaN(parseInt($('#pidopd').select2('val'))))
                            formData.append('pidopd',parseInt($('#pidopd').select2('val')))
                        if (!isNaN(parseInt($('#pidopd_cabang').select2('val'))))
                            formData.append('pidopd_cabang',parseInt($('#pidopd_cabang').select2('val')))
                        if (!isNaN(parseInt($('#pidupt').select2('val'))))
                            formData.append('pidupt',parseInt($('#pidupt').select2('val')))

                        __ajax({
                            method: 'POST',
                            url: "<?= url('api/inventaris', isset($inventaris) ? [$inventaris->id] : []) ?>",
                            data: formData,
                            processData: false,
                            contentType: false,

                        }).then((d, resp) => {
                            swal.fire({
                                type: "success",
                                text: "Berhasil menyimpan data!",
                                onClose: () => {
                                    let url = "<?= isset($_GET['menuback']) ? $_GET['menuback'] : '' ?>"

                                    if (isUbahSatuan != 'yes') {
                                        if (url == '') {
                                            window.location = `${$('[base-path]').val()}/inventaris`
                                        } else {
                                            window.location = url
                                        }
                                    } else {
                                        Swal.fire({
                                            title: '',
                                            html: `Apakah ingin menambah data inventaris lagi?`,
                                            type: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Ya!'
                                        }).then((result) => {
                                            if(result.value) {
                                                window.location.reload()
                                            } else {
                                                if (url == '') {
                                                    window.location = `${$('[base-path]').val()}/inventaris`
                                                } else {
                                                    window.location = url
                                                }
                                            }
                                        })

                                    }


                                }
                            })

                        })
                    }
            })

        }

        const form = document.querySelector('#form-inventaris')
        form.addEventListener('submit', (ev) => {
            ev.preventDefault()

            onSave(false)
        })
    </script>

    @if (isset($inventaris))
    <script>
        <?php
            $organisasi = \App\Models\organisasi::find(Auth::user()->pid_organisasi);
            $jabatan = \App\Models\jabatan::find(Auth::user()->jabatan);
        ?>
        App.Helpers.defaultSelect2(
            $('#satuan'),
            "<?= url('api/satuanbarangs', [$inventaris->satuan]) ?>",
            "id",
            "nama"
        )


        $(".baranglookup").LookupTable().setValAjax("<?= url('api/barangs', [$inventaris->pidbarang]) ?>").then((d) => {
                viewModel.data.pidinventaris = <?= $inventaris->id ?>;
                funcBarangSelect(d)
        })

        let kelompok = parseInt("<?= $jabatan->kelompok ?>")

        if (kelompok >= 2)
            $('#pidupt').select2('enable', false)
        if (kelompok >= 1)
            $('#pidopd_cabang').select2('enable', false)
        if (kelompok >= 0)
            $('#pidopd').select2('enable', false)

        @if ($inventaris->alamat_propinsi)
            App.Helpers.defaultSelect2($('#alamat_propinsi'), "<?= url('api/alamats', [$inventaris->alamat_propinsi]) ?>", "id", "nama", () => {
                @if ($inventaris->alamat_kota)
                    App.Helpers.defaultSelect2($('#alamat_kota'), "<?= url('api/alamats', [$inventaris->alamat_kota]) ?>", "id", "nama", () => {
                        @if ($inventaris->alamat_kecamatan)
                            App.Helpers.defaultSelect2($('#alamat_kecamatan'), "<?= url('api/alamats', [$inventaris->alamat_kecamatan]) ?>", "id", "nama", () => {
                                @if ($inventaris->alamat_kelurahan)
                                    App.Helpers.defaultSelect2($('#alamat_kelurahan'), "<?= url('api/alamats', [$inventaris->alamat_kelurahan]) ?>", "id", "nama", () => {

                                    }) // END: #defaultSelect2 #alamat_kelurahan
                                @endif
                            }) // END: #defaultSelect2 #alamat_kecamatan
                        @endif
                    }) // END: #defaultSelect2 #alamat_kota
                @endif
            }) // END: #defaultSelect2 #alamat_propinsi
        @endif // if alamat_propinsi

        @if ($inventaris->pidopd)
            App.Helpers.defaultSelect2($('#pidopd'), "<?= url('api/organisasis', [$inventaris->pidopd]) ?>","id","nama", () => {
                @if ($inventaris->pidopd_cabang)
                    App.Helpers.defaultSelect2($('#pidopd_cabang'), "<?= url('api/organisasis', [$inventaris->pidopd_cabang]) ?>","id","nama", () => {
                        @if ($inventaris->pidupt)
                            App.Helpers.defaultSelect2($('#pidupt'), "<?= url('api/organisasis', [$inventaris->pidupt]) ?>","id","nama")
                        @endif
                    })
                @endif
            })
        @endif
    </script>
    @else
        @if(Auth::user()->pid_organisasi)
            <?php
                $jabatan = \App\Models\jabatan::find(Auth::user()->jabatan);
                $organisasi = \App\Models\organisasi::find(Auth::user()->pid_organisasi);
            ?>
            @if($jabatan->kelompok == 0)
                <script>
                    $('#pidopd').select2('enable', false)
                    App.Helpers.defaultSelect2($('#pidopd'), "<?= url('api/organisasis', [$organisasi->id]) ?>","id","nama")
                </script>
            @endif
            @if($jabatan->kelompok == 1)
                <script>
                        $('#pidopd').select2('enable', false)
                        $('#pidopd_cabang').select2('enable', false)
                    App.Helpers.defaultSelect2($('#pidopd'), "<?= url('api/organisasis', [$organisasi->pid]) ?>","id","nama", () => {
                        if ("<?= $organisasi->pid ?>" == "") {
                            return
                        }
                        App.Helpers.defaultSelect2($('#pidopd_cabang'), "<?= url('api/organisasis', [$organisasi->id]) ?>","id","nama")
                    })
                </script>
            @endif
            @if($jabatan->kelompok == 2)
                <?php
                    $pidOrganisasiInduk = "";
                    $organisasiInduk = \App\Models\organisasi::find($organisasi->pid);
                    if ($organisasiInduk) {
                        $pidOrganisasiInduk = $organisasiInduk->pid;
                    }
                ?>
                <script>

                    $('#pidupt').select2('enable', false)
                    $('#pidopd_cabang').select2('enable', false)
                    $('#pidopd').select2('enable', false)
                    App.Helpers.defaultSelect2($('#pidopd'), "<?= url('api/organisasis', [$pidOrganisasiInduk]) ?>","id","nama", () => {
                        if ("<?= $organisasi->pid ?>" == "") {
                            return
                        }
                        App.Helpers.defaultSelect2($('#pidopd_cabang'), "<?= url('api/organisasis', [$organisasi->pid]) ?>","id","nama", () => {
                            App.Helpers.defaultSelect2($('#pidupt'), "<?= url('api/organisasis', [$organisasi->id]) ?>","id","nama")
                        })
                    })
                </script>
            @endif
        @endif
    @endif



@endsection

@include('inventaris.formkib')


@if(!isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1)
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}

    @if ((isset($inventaris) && !empty($inventaris->draft)) || !isset($inventaris) && !isset($_GET['id_sensus']))
        <div class="btn btn-info" onclick="onSave(true)">Draft</div>
    @endif
    <a href="{!! route('inventaris.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif
