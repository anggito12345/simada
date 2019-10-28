
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
        
        {!! Form::number('tahun_perolehan', null, ['class' => 'form-control', 'maxlength' => 4, 'required' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text text-danger" id="basic-addon2">4 digit(mis: 2018)</span>
        </div>
    </div>
</div>

<!-- Harga Satuan Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('harga_satuan', 'Harga Satuan:') !!} <span class="text-danger">*</span>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
        </div>
        {!! Form::text('harga_satuan', null, ['class' => 'form-control', 'required' => true]) !!}        
    </div>   
</div>


<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpozs($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    <div class="row">
        <div class="col-md-6">
            {!! Form::label('jumlah', 'Jumlah') !!} <span class="text-danger">*</span>
            <div class="input-group col-md-12 no-padding mr-2">            
                {!! Form::number('jumlah',  (isset($inventaris) ? $inventaris->jumlah : 1 ), ['class' => 'form-control', 'max' => 99, 'required' => true]) !!}       
                <div class="input-group-append">
                    <span class="input-group-text text-danger" id="basic-addon2">(max: 99)</span>
                </div> 
            </div>
        </div>
        <div class="col-md-6">
            {!! Form::label('satuan', 'Satuan') !!} <span class="text-danger">*</span>
            <div class="input-group col-md-12 no-padding">        
                {!! Form::select('satuan', [], null, ['class' => 'form-control', 'required' => true]) !!}                
            </div>
        </div>
    </div>
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
    {!! Form::label('tgl_dibukukan', 'Tgl Dibukukan:') !!}
    {!! Form::text('tgl_dibukukan', null, ['class' => 'form-control tgl_dibukukan','id'=>'tgl_dibukukan']) !!}
</div>


<!-- Tgl Sensus Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('tgl_sensus', 'Tgl Sensus:') !!}
    {!! Form::text('tgl_sensus', null, ['class' => 'form-control tgl_sensus','id'=>'tgl_sensus']) !!}
</div>

<!-- Provinsi Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('alamat_propinsi', 'Provinsi:') !!} <span class="text-danger">*</span>
    {!! Form::select('alamat_propinsi', [] , "", ['class' => 'form-control']) !!}
</div>

<!-- Kota Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('alamat_kota', 'Kota:') !!} <span class="text-danger">*</span>
    {!! Form::select('alamat_kota', [] , "", ['class' => 'form-control']) !!}
</div>

<!-- pid opd Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidopd', 'Pengguna Barang') !!} <span class="text-danger">*</span>
    {!! Form::select('pidopd', [] , "", ['class' => 'form-control']) !!}
</div>

<!-- pid opd cabang Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidopd_cabang', 'Kuasa Pengguna Barang') !!} <span class="text-danger">*</span>
    {!! Form::select('pidopd_cabang', [] , null, ['class' => 'form-control']) !!}
</div>

<!-- pid upt Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidupt', 'Sub Kuasa Pengguna Barang') !!} <span class="text-danger">*</span>
    {!! Form::select('pidupt', [] , null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Lokasi Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_lokasi', 'Kode Lokasi:') !!}
    {!! Form::text('kode_lokasi', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
</div>

<div data-bind='visible:viewModel.data.tipeKib() == "KIB A"' class="form-group col-sm-12 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-12' : 'col-md-12' ?> row">
    {!! Form::file('dokumen', ['class' => 'form-control','id'=>'dokumen', 'name' => 'dummy', 'multiple' => true]) !!}
</div>

<div data-bind='visible:viewModel.data.tipeKib() == "KIB A"' class="form-group col-sm-12 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-12' : 'col-md-12' ?> row">
    {!! Form::file('foto', ['class' => 'form-control','id'=>'foto', 'name' => 'dummy', 'multiple' => true]) !!}
</div>

<!-- Pidlokasi Field -->
<!-- <div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidlokasi',__("field.pidlokasi")) !!}
    {!! Form::select('pidlokasi',[], null, ['class' => 'form-control form-control-lg']) !!}
</div> -->

@section(!isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'scripts' : 'scripts_2')
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


        $('#alamat_propinsi').on('change', function (e) {
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

        $('#harga_satuan').mask("#.##0", {reverse: true});

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

        new inlineDatepicker(document.getElementsByClassName('tgl_dibukukan'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });

        new inlineDatepicker(document.getElementsByClassName('tgl_sensus'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });

        var fileGallery = new FileGallery(document.getElementById('dokumen'), {
            title: 'File Dokumen',
            maxSize: 5000000,
            accept: App.Constant.MimeOffice,
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
            title: 'Foto',
            maxSize: 3000000,
            accept: "image/*",
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
            
                        formData.append(`draft`, isDraft)

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
                        formData.append(`kode_lokasi`, $('#kode_lokasi').val())
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
                                    window.location = `${$('[base-path]').val()}/inventaris`
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

        <?php 
            $kodeStatus = \App\Models\setting::where('nama', 'KODE_LOKASI_STATUS')->first()->nilai;
            $kodePropinsi = \App\Models\setting::where('nama', 'KODE_PROPINSI')->first()->nilai;
            $kodeKota = \App\Models\setting::where('nama', 'KODE_KOTA')->first()->nilai;
        ?>

        $("#pidbarang, #tahun_perolehan, #harga_satuan, #pidopd, #pidopd_cabang, #pidupt, #alamat_propinsi, #alamat_kota").change(() => {

            let propinsiKode = 0
            if ($("#alamat_propinsi").select2('val') != null) {
                propinsiKode = $("#alamat_propinsi").select2('data')[0].kode            
            }

            if (propinsiKode == undefined && $("#alamat_propinsi").select2('val') != null &&  $("#alamat_propinsi").select2('val') != "") {                
                propinsiKode = $("#alamat_propinsi").select2('data')[0].element.dataset.kode                
            }

            if (propinsiKode == undefined)
                propinsiKode = 0

            let kotaKode = 0
            if ($("#alamat_kota").select2('val') != null) {
                kotaKode = $("#alamat_kota").select2('data')[0].kode            
            }

            if (kotaKode == undefined && $("#alamat_kota").select2('val') != null &&  $("#alamat_kota").select2('val') != "") {                
                kotaKode = $("#alamat_kota").select2('data')[0].element.dataset.kode                
            }

            if (kotaKode == undefined)
                kotaKode = 0

            let pidOpd = 0
            if ($("#pidopd").select2('val') != null) {
                pidOpd = $("#pidopd").select2('data')[0].kode            
            }

            if (pidOpd == undefined && $("#pidopd").select2('val') != null &&  $("#pidopd").select2('val') != "") {                
                pidOpd = $("#pidopd").select2('data')[0].element.dataset.kode                
            }

            if (pidOpd == undefined)
                pidOpd = 0

            let pidOpdCabang = 0
            if ($("#pidopd_cabang").select2('val') != null) {
                pidOpdCabang = $("#pidopd_cabang").select2('data')[0].kode             
            }

            if (pidOpdCabang == undefined && $("#pidopd_cabang").select2('val') != null && $("#pidopd_cabang").select2('val') != "") {                
                pidOpdCabang = $("#pidopd_cabang").select2('data')[0].element.dataset.kode                
            } 

            if (pidOpdCabang == undefined)
                pidOpdCabang = 0

            let pidUpt = 0
            if ($("#pidupt").select2('val') != null) {
                pidUpt = $("#pidupt").select2('data')[0].kode                
            }

            if (pidUpt == undefined && $("#pidupt").select2('val') != null && $("#pidupt").select2('val') != "") {                
                pidUpt = $("#pidupt").select2('data')[0].element.dataset.kode                                   
            }

            if (pidUpt == undefined)
                pidUpt = 0

            
            if ($("#tahun_perolehan").val() != "" && $("#harga_satuan").val() != "") {
                __ajax({
                    method:'GET',
                    url: "<?= url('api/intraorekstra') ?>",
                    data: {
                        "tahun_perolehan" : $("#tahun_perolehan").val(),
                        "harga_satuan": $("#harga_satuan").val()
                    }
                }).then(() => {
                    $("#kode_lokasi").val(
                        "<?= $kodeStatus ?>" + "." 
                        + propinsiKode + "." 
                        + kotaKode + "." 
                        + pidOpd + "."
                        + pidOpdCabang + "." 
                        + pidUpt + "." 
                        + $("#tahun_perolehan").val() )
                })
            } else {
                $("#kode_lokasi").val("Isi tahun perolehan dan harga satuan terlebih dahulu!")
            }
                
        })
    </script>

    @if (isset($inventaris))
    <script>        
        <?php 
            $organisasi = \App\Models\organisasi::find(Auth::user()->pid_organisasi); 
            $jabatan = \App\Models\jabatan::find(Auth::user()->jabatan);                      
        ?>
        App.Helpers.defaultSelect2($('#satuan'), "<?= url('api/satuanbarangs', [$inventaris->satuan]) ?>","id","nama")
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

        App.Helpers.defaultSelect2($('#alamat_propinsi'), "<?= url('api/alamats', [$inventaris->alamat_propinsi]) ?>","id","nama", () => {           
            
            App.Helpers.defaultSelect2($('#alamat_kota'), "<?= url('api/alamats', [$inventaris->alamat_kota]) ?>","id","nama", () => {              
                
            }) 
        })

        App.Helpers.defaultSelect2($('#pidopd'), "<?= url('api/organisasis', [$inventaris->pidopd]) ?>","id","nama", () => {           
            App.Helpers.defaultSelect2($('#pidopd_cabang'), "<?= url('api/organisasis', [$inventaris->pidopd_cabang]) ?>","id","nama", () => {              
                App.Helpers.defaultSelect2($('#pidupt'), "<?= url('api/organisasis', [$inventaris->pidupt]) ?>","id","nama")
            }) 
        })
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
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

    @if ((isset($inventaris) && !$inventaris->draft) || !isset($inventaris))
        <div class="btn btn-primary" onclick="onSave(true)">Draft</div>
    @endif
    <a href="{!! route('inventaris.index') !!}" class="btn btn-default">Cancel</a>
</div>
@endif
