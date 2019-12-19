<!-- Blank Field -->
<div class="form-group col-sm-6">
    {!! Form::label('', '') !!}
</div>

<!-- Tglhapus Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tglhapus', 'Tanggal Penghapusan:') !!}
    {!! Form::text('tglhapus', null, ['class' => 'form-control','id'=>'tglhapus', 'data-bind' => 'input: viewModel.data.formPenghapusan().tglhapus']) !!}
</div>

<!-- Kriteria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kriteria', 'Kriteria Penghapusan:') !!}
    {!! Form::select('kriteria', [
    'Pemindahtanganan' => 'Pemindahtanganan',
    'Pemusnahan' => 'Pemusnahan',
    'Penghapusan' => 'Penghapusan'
    ], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().kriteria']) !!}
</div>

<!-- Kondisi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kondisi', 'Kondisi Akhir Barang:') !!}
    {!! Form::select('kondisi', \App\Models\BaseModel::$kondisiDs ,null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().kondisi']) !!}
</div>

<!-- Harga Apprisal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('harga_apprisal', 'Harga Appraisal:') !!}
    {!! Form::number('harga_apprisal', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().harga_apprisal']) !!}
</div>

<!-- Dokumen Field -->
<div class="form-group col-sm-12">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::file('dokumen', ['class' => 'form-control', 'name' => 'dummy-dokumen']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-12">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::file('foto', ['class' => 'form-control', 'name' => 'dummy-foto']) !!}
</div>

<label>Dasar SK Gurbenur</label>

<!-- Nosk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nosk', 'No:') !!}
    {!! Form::text('nosk', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().nosk']) !!}
</div>

<!-- Tglsk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tglsk', 'Tanggal:') !!}
    {!! Form::text('tglsk', null, ['class' => 'form-control','id'=>'tglsk', 'data-bind' => 'value: viewModel.data.formPenghapusan().tglsk']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().keterangan']) !!}
</div>


<div class="form-group col-sm-12">
    <table id="table-detil-penghapusan" class="table table-striped ">
        <thead>
        </thead>
    </table>
</div>


<div class="form-group col-sm-6">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    @if(isset($penghapusan) && !empty($penghapusan->draft) || !isset($penghapusan))
    <div class="btn btn-primary" onclick="doSave(true)">Draft</div>
    @endif
    <a href="{!! route('penghapusans.index') !!}" class="btn btn-default">Batal</a>
</div>

@section('scripts')
<script src="<?= url('js/thirdparty/dataTables.editor.min.js') ?>"></script>
<!-- why imported here because it would overwrite colvis button javascript which is affected on button create click event. -->
<?php
                $dataDetils = json_encode([]);
                if (isset($penghapusan)) {
                    $dataDetils = json_encode(\App\Models\inventaris_penghapusan::where('pid_penghapusan', $penghapusan->id)
                        ->select([
                            'inventaris_penghapusan.id_pk as DT_RowId',
                            'm_barang.nama_rek_aset as inventarisNama',
                            'inventaris_penghapusan.id as inventaris',
                            'inventaris_penghapusan.tahun_perolehan as tahun_perolehan',
                        ])
                        ->join('m_barang', 'm_barang.id', 'inventaris_penghapusan.pidbarang')
                        ->get());
                }

?>

<script>
    var fileGallery, foto

    let dataDetils = JSON.parse('<?= $dataDetils ?>')

    new inlineDatepicker(document.getElementById('tglhapus'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });

    new inlineDatepicker(document.getElementById('tglsk'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
        value: viewModel.data.formPenghapusan().tglhapus
    });


    fileGallery = new FileGallery(document.getElementById('dokumen'), {
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
                    onPenghapusanGetFiles(checkIfIdExist[0].foreign_id, () => {})
                })
            })
        }
    })

    foto = new FileGallery(document.getElementById('foto'), {
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
                    onPenghapusanGetFiles(checkIfIdExist[0].foreign_id, () => {})
                })
            })
        }
    })

    function doSave(isDraft) {
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
                let url = $("[base-path]").val() + "/api/penghapusans"
                let formData = new FormData($('#form-penghapusan')[0])
                let method = "POST"

                for (let index = 0; index < fileGallery.fileList().length; index++) {
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

                    formData.append(`dokumen_metadata_id_inventaris[${index}]`, $("#table-inventaris").DataTable().rows('.selected').data()[0].id)
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

                    formData.append(`foto_metadata_id_inventaris[${index}]`, $("#table-inventaris").DataTable().rows('.selected').data()[0].id)

                    return d.rawFile
                })

                formData.append('detil', JSON.stringify($("#table-detil-penghapusan").DataTable().rows().data().toArray()));
                formData.append('draft', isDraft ? '1' : '')

                __ajax({
                    method: method,
                    url: "<?= url('api/penghapusans', isset($penghapusan) ? [$penghapusan->id] : []) ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                }).then((d, resp) => {
                    swal.fire({
                        type: "success",
                        text: "Berhasil menyimpan data!",
                        onClose: () => {
                            window.location = `${$('[base-path]').val()}/penghapusans`


                        }
                    })

                })
            }
        });

    }

    const form = document.querySelector('#form-penghapusan')
    form.addEventListener('submit', (ev) => {
        ev.preventDefault()

        doSave(false)
    })

    editor = new $.fn.dataTable.Editor({
        table: "#table-detil-penghapusan",
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
                        url: `${$('[base-path]').val()}/inventaris?is_exist_inventaris_penghapusan=false`,
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

<script>
    $('#table-detil-penghapusan').DataTable({
        buttons: buttonsOpt,
        data: dataDetils,
        dom: 'Bfrtip',
        searching: false,
        "lengthChange": false,
        "ordering": true,
        "aaSorting": [
            [0, "desc"]
        ],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        columns: [{
                data: null,
                defaultContent: '',
                className: 'select-checkbox',
                orderable: false,
                width: 20,
            },
            {
                data: 'inventarisNama',
                title: 'Inventaris',
                orderable: false,
            },
            {
                data: 'tahun_perolehan',
                title: 'Tahun Perolehan',
                orderable: false,
            }
        ]
    })
</script>
@endsection