<!-- Blank Field -->
<div class="form-group col-sm-6">
    {!! Form::label('', '') !!}
</div>

@if(!isset($isInventarisPage))
<!-- pid Field -->
<div class="form-group col-6">
    {!! Form::label('pidinventaris', 'Inventaris:') !!}
    {!! Form::text('pidinventaris', null, ['id' => 'pidinventaris_pemanfaatan', 'class' => 'form-control']) !!}
</div>

@endif
<!-- Peruntukan Field -->
<div class="form-group col-6">
    {!! Form::label('peruntukan', __('field.peruntukan')) !!}
    {!! Form::select('peruntukan', \App\Models\BaseModel::$peruntukanDs , null, ['class' => 'form-control']) !!}
</div>

<!-- Umur Field -->
<div class="form-group col-6">
    {!! Form::label('umur', __('field.umur')) !!}
    <div class="input-group">
        {!! Form::number('umur', null, [ 'onchange' => 'changeTanggalAkhir(this)', 'class' => 'form-control']) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2">
            {!! Form::select('umur_satuan',array('Hari' => 'Hari', 'Minggu' => 'Minggu', 'Bulan' => 'Bulan', 'Tahun' => 'Tahun'), null, ['class' => 'form-control']) !!}
            </span>
        </div>
    </div>

</div>

<!-- No Perjanjian Field -->
<div class="form-group col-6">
    {!! Form::label('no_perjanjian', 'No Perjanjian:') !!}
    {!! Form::text('no_perjanjian', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Mulai Field -->
<div class="form-group col-6">
    {!! Form::label('tgl_mulai', 'Tgl Mulai:') !!}
    {!! Form::text('tgl_mulai', null, ['class' => 'form-control','id'=>'tgl_mulai']) !!}
</div>

<!-- Tgl Akhir Field -->
<div class="form-group col-6">
    {!! Form::label('tgl_akhir', 'Tgl Akhir:') !!}
    {!! Form::text('tgl_akhir', null, ['class' => 'form-control','id'=>'tgl_akhir', 'readonly' => 'readonly']) !!}
</div>

<!-- Mitra Field -->
<div class="form-group col-6">
    {!! Form::label('mitra', 'Mitra:') !!}
    {!! Form::select('mitra',[] ,null, ['class' => 'form-control']) !!}
</div>

<!-- Tipe Kontribusi Field -->
<div class="form-group col-6">
    {!! Form::label('tipe_kontribusi', 'Tipe Kontribusi:') !!}
    {!! Form::select('tipe_kontribusi', \App\Models\BaseModel::$tipeKontribusiDs ,null, ['onchange' => 'notifySubscribersManually()', 'class' => 'form-control']) !!}
</div>

<!-- Tetap Field -->
<!-- ko if: viewModel.data.formPemanfaatan().tipe_kontribusi == '2' -->
<div class="form-group col-6">
    {!! Form::label('tetap', 'Tetap:') !!}
    {!! Form::number('tetap' , "", ['class' => 'form-control']) !!}
</div>

<!-- Bagi Hasil Field -->
<div class="form-group col-6">
    {!! Form::label('bagi_hasil', 'Bagi Hasil:') !!}
    {!! Form::number('bagi_hasil', "", ['class' => 'form-control']) !!}
</div>
<!-- /ko -->

<!-- ko if: viewModel.data.formPemanfaatan().tipe_kontribusi != '2' -->
<div class="form-group col-6">
    {!! Form::label('jumlah_kontribusi', 'Jumlah Kontribusi:') !!}
    {!! Form::number('jumlah_kontribusi', null, ['class' => 'form-control']) !!}
</div>
<!-- /ko -->

<!-- Pegawai Field -->
<!-- <div class="form-group col-6">
    {!! Form::label('pegawai', 'Pegawai:') !!}
    {!! Form::number('pegawai', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().pegawai']) !!}
</div> -->

<!-- Dokumen Field -->
<div class="form-group col-md-12">
    {!! Form::label('dokumen_pemanfaatan', 'Dokumen:') !!}
    {!! Form::file('dokumen_pemanfaatan', ['class' => 'form-control', 'name' => 'dummy-dokumen']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-md-12">
    {!! Form::label('foto_pemanfaatan', 'Foto:') !!}
    {!! Form::file('foto_pemanfaatan', ['class' => 'form-control', 'name' => 'dummy-foto']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    @if(isset($pemanfaatan) && !empty($pemanfaatan->draft) || !isset($pemanfaatan))
    <div class="btn btn-primary" onclick="doSave(true)">Draft</div>
    @endif
    <a href="{!! route('pemanfaatans.index') !!}" class="btn btn-default">Batal</a>
</div>


@section('scripts')
<script src="<?= url('js/thirdparty/dataTables.editor.min.js') ?>"></script>
<!-- Submit Field -->
<!-- <div class="form-group col-6">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('pemanfaatans.index') !!}" class="btn btn-default">Batal</a>
</div> -->
<script>
    if ($("#pidinventaris_pemanfaatan").length > 0) {

        $("#pidinventaris_pemanfaatan").LookupTable({
            DataTable: {
                ajax: {
                    url: $("[base-path]").val() + "/inventaris",
                    dataSrc: 'data',
                    data: (d) => {
                        return d
                    },
                    headers: {
                        'Authorization': 'Bearer ' + sessionStorage.getItem('api token'),
                    }
                },
                columns: [{
                        data: 'noreg',
                        title: 'Nomor Registrasi'
                    },
                    {
                        data: 'nama_rek_aset',
                        'name': 'm_barang.nama_rek_aset',
                        title: 'Nama Barang'
                    },
                    {
                        data: 'tahun_perolehan',
                        title: 'Tahun Perolehan'
                    },

                ],
                "processing": true,
                "serverSide": true,
                "searching": true,
                responsive: true,
                custom: {
                    typeInput: 'radio',
                    textField: 'nama_rek_aset',
                    valueField: 'id',
                    autoClose: false,
                    filters: [
                        // { name: "nama_rek_aset", type:"text", title: "Ketik nama barang yang dicari"},
                    ]
                }
            }
        })
    }
    var fileGalleryPemanfaatan, fotoPemanfaatan

    function changeTanggalAkhir(obj) {
        setTimeout(() => {
            viewModel.data.formPemanfaatan().tgl_akhir = moment(viewModel.data.formPemanfaatan().tgl_mulai, "DD-MM-YYYY").add(viewModel.data.formPemanfaatan().umur, 'days').format("DD-MM-YYYY");
            notifySubscribersManually()
        }, 1000);
    }

    function notifySubscribersManually() {
        setTimeout(() => {
            viewModel.data.formPemanfaatan.notifySubscribers()
        }, 100);
    }

    new inlineDatepicker(document.getElementById('tgl_mulai'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });


    // new inlineDatepicker(document.getElementById('tgl_akhir'), {
    //     format: 'DD-MM-YYYY',
    //     buttonClear: true,
    //     value: viewModel.data.formPemanfaatan().tglhapus
    // });

    $('#mitra').select2({
        ajax: {
            url: "<?= url('api/mitras') ?>",
            dataType: 'json',
            processResults: function(data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data
                };
            }
        },
        theme: 'bootstrap',
    })

    fileGalleryPemanfaatan = new FileGallery(document.getElementById('dokumen_pemanfaatan'), {
        title: 'File Dokumen',
        maxSize: 5000000,
        accept: App.Constant.MimeOffice,
        onDelete: () => {
            return new Promise((resolve, reject) => {
                let checkIfIdExist = fileGalleryPemanfaatan.checkedRow().filter((d) => {
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
                    onPemanfaatanGetFiles(checkIfIdExist[0].foreign_id, () => {})
                })
            })
        }
    })
    fotoPemanfaatan = new FileGallery(document.getElementById('foto_pemanfaatan'), {
        title: 'Foto',
        maxSize: 3000000,
        accept: "image/*",
        onDelete: () => {
            return new Promise((resolve, reject) => {
                let checkIfIdExist = fotoPemanfaatan.checkedRow().filter((d) => {
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
                    onPemanfaatanGetFiles(checkIfIdExist[0].foreign_id, () => {})
                })
            })
        }
    })

    function doSave(isDraft) {
        let url = $("[base-path]").val() + "/api/pemanfaatans"
        let formData = new FormData($('#form-pemanfaatan')[0])
        let method = "POST"

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
                for (let index = 0; index < fileGalleryPemanfaatan.fileList().length; index++) {
                    const d = fileGalleryPemanfaatan.fileList()[index]
                    if (d.rawFile) {
                        formData.append(`dokumen_pemanfaatan[${index}]`, d.rawFile)
                    } else {
                        formData.append(`dokumen_pemanfaatan[${index}]`, false)
                    }

                    let keys = Object.keys(d)

                    keys.forEach((key) => {
                        if (key == 'rawFile') {
                            return
                        }
                        formData.append(`dokumen_pemanfaatan_metadata_${key}[${index}]`, d[key])
                    })

                    formData.append(`dokumen_pemanfaatan_metadata_id_inventaris[${index}]`, $("#table-inventaris").DataTable().rows('.selected').data()[0].id)
                }

                fotoPemanfaatan.fileList().forEach((d, index) => {
                    if (d.rawFile) {
                        formData.append(`foto_pemanfaatan[${index}]`, d.rawFile)
                    } else {
                        formData.append(`foto_pemanfaatan[${index}]`, false)
                    }

                    let keys = Object.keys(d)

                    keys.forEach((key) => {
                        if (key == 'rawFile') {
                            return
                        }
                        formData.append(`foto_pemanfaatan_metadata_${key}[${index}]`, d[key])
                    })

                    formData.append(`foto_pemanfaatan_metadata_id_inventaris[${index}]`, $("#table-inventaris").DataTable().rows('.selected').data()[0].id)

                    return d.rawFile
                })

                formData.append('detil', JSON.stringify($("#table-detil-pemanfaatan").DataTable().rows().data().toArray()));
                formData.append('draft', isDraft ? '1' : '')

                __ajax({
                    method: method,
                    url: "<?= url('api/pemanfaatans', isset($pemanfaatan) ? [$pemanfaatan->id] : []) ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                }).then((d, resp) => {
                    swal.fire({
                        type: "success",
                        text: "Berhasil menyimpan data!",
                        onClose: () => {
                            window.location = `${$('[base-path]').val()}/pemanfaatans`


                        }
                    })

                })
            }
        })


    }

    const form = document.querySelector('#form-pemanfaatan')
    form.addEventListener('submit', (ev) => {
        ev.preventDefault()

        doSave(false)
    })

    editor = new $.fn.dataTable.Editor({
        table: "#table-detil-pemanfaatan",
        fields: [{
            label: "Inventaris:",
            name: "inventaris",
            type: "select"
        }]
    });

    let buttonsOpt = [{
            extend: "create",
            editor: editor
        },
        {
            extend: "edit",
            editor: editor
        },
        {
            extend: "remove",
            editor: editor
        },
    ]

    let editorInit = false
    let DTE_Field_inventaris = null

    editor.on('open', function(e, type) {

        $('#DTE_Field_inventaris').val('')

        if (DTE_Field_inventaris == null) {
            DTE_Field_inventaris = new lookupTable(document.getElementById('DTE_Field_inventaris'), {
                dataTableOption: {
                    ajax: {
                        url: `${$('[base-path]').val()}/inventaris?is_exist_inventaris_pemanfaatan=false`,
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + sessionStorage.getItem('api token'),
                        }
                    },
                    cache: true,
                    columns: [{
                            data: 'kode_barang',
                            title: 'Kode Barang'
                        },

                        {
                            data: 'noreg',
                            title: 'Noreg'
                        },
                        {
                            data: 'perolehan',
                            title: 'Cara Perolehan'
                        },

                        {
                            data: 'tahun_perolehan',
                            title: 'Tahun Perolehan'
                        },
                        {
                            data: 'kondisi',
                            title: 'Keadaan Barang'
                        },
                        {
                            data: 'harga_satuan',
                            title: 'Harga Satuan'
                        },
                    ],
                    'select': {
                        'style': 'multiple'
                    },
                    "processing": true,
                    "serverSide": true,
                },
                dataFieldLabel: 'nama_rek_aset',
                dataFieldValue: 'id',
                multiple: true
            });
            editorInit = true
        }
        DTE_Field_inventaris.setDefault(null)
    });


    editor.on('preSubmit', function(e, data, action) {
        if (DTE_Field_inventaris.selectedValues.length <= 0) {
            this.field('inventaris').error('Mohon pilih inventaris terlebih dahulu!');
        }

        if (this.inError()) {
            return false;
        }


        dataSelect = DTE_Field_inventaris.selectedValues
        if (action == 'create') {
            dataSelect.forEach((dataVal, index) => {

                if (data.data[index] == undefined) {
                    data.data[index] = {
                        inventaris: parseInt(dataVal.id),
                        inventarisNama: dataVal.nama_rek_aset,
                        tahun_perolehan: dataVal.tahun_perolehan,
                    }
                } else {
                    data.data[0].inventaris = parseInt(dataVal.id);
                    data.data[0].inventarisNama = dataVal.nama_rek_aset;
                    data.data[0].tahun_perolehan = dataVal.tahun_perolehan;
                }

            })

        } else {
            $.each(data.data, function(key, values) {
                data.data[key]['inventaris'] = parseInt(dataSelect[0].id);
                data.data[key]['inventarisNama'] = dataSelect[0].nama_rek_aset;
                data.data[key]['tahun_perolehan'] = dataSelect[0].tahun_perolehan;
            });
        }


    });

    editor.on('initEdit', function(e, node, data) {


        setTimeout(() => {
            __ajax({
                url: "<?= url('api/inventaris') ?>/" + data.inventaris,
                method: 'GET',
                dataType: 'json'
            }).then((d) => {
                DTE_Field_inventaris.setDefault(d)
            })
        }, 1);


    });

    editor.on('postSubmit', function(e, node, data) {

        DTE_Field_inventaris.setDefault(null)
    });
</script>

@if(isset($pemanfaatan))
<script>
    $("#pidinventaris_pemanfaatan").LookupTable().setValAjax("<?= url('api/inventaris', [$pemanfaatan->pidinventaris]) ?>").then((d) => {})
</script>
@endif

@endsection