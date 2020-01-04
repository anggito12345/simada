

<!-- Opd Asal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opd_asal', 'OPD Asal:') !!}
    {!! Form::select('opd_asal', [], null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
</div>

<!-- Opd Tujuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opd_tujuan', 'OPD Tujuan:') !!}
    {!! Form::select('opd_tujuan', [], null, ['class' => 'form-control']) !!}
</div>

<!-- No Bast Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_bast', 'No BAST:') !!}
    {!! Form::text('no_bast', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Bast Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_bast', 'Tanggal BAST:') !!}
    {!! Form::text('tgl_bast', null, ['class' => 'form-control','id'=>'tgl_bast']) !!}
</div>

<!-- Dokumen Field -->
<div class="form-group col-sm-12">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::file('dokumen', ['class' => 'form-control']) !!}
</div>

<!-- Alasan Mutasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alasan_mutasi', 'Alasan Mutasi:') !!}
    {!! Form::textarea('alasan_mutasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    <table id="table-detil-mutasi" class="table table-striped ">
        <thead>
        </thead>
    </table>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-6">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    @if ((isset($mutasi) && !empty($mutasi->draft)) || !isset($mutasi))
        <div class="btn btn-info" onclick="doSave(true)">Draft</div>
    @endif
    <a href="{!! route('mutasis.index') !!}" class="btn btn-default">Batal</a>
</div>
@section('scripts')


<script src="<?= url('js/thirdparty/dataTables.editor.min.js') ?>"></script>
<!-- why imported here because it would overwrite colvis button javascript which is affected on button create click event. -->
<?php 
    $dataDetils = json_encode([]);
    if(isset($mutasi)) {
        $dataDetils = json_encode(\App\Models\mutasi_detil::where('pid', $mutasi->id)
            ->select([
                'm_barang.nama_rek_aset as inventarisNama',
                'mutasi_detil.keterangan',
                'inventaris.id as inventaris',
                'mutasi_detil.id as DT_RowId'
            ])
            ->join('inventaris','inventaris.id', 'mutasi_detil.inventaris')
            ->join('m_barang','m_barang.id', 'inventaris.pidbarang')
            ->get());
    }

?>


<script type="text/javascript">
    

    let dataDetils = JSON.parse('<?= $dataDetils ?>')
    const funcGetDokumenFileList = () => {
        __ajax({
            method: 'GET',
            url: "<?= url('api/system_uploads') ?>",
            data: {
                jenis: 'dokumen',
                foreign_field: 'id',
                foreign_id: <?= isset($mutasi) ? $mutasi->id : 'null' ?>,
                foreign_table: 'mutasi',                    
            },
        }).then((files) => {                
            fileGallery.fileList(files)
        }) 
    }


    $('#opd_asal').select2({
        ajax: {
            url: "<?= url('api/organisasis') ?>",
            dataType: 'json',
            data: function (params) {
                var query = {
                    q: params.term,                                           
                    level: '0'
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

    $('#opd_tujuan').select2({
        ajax: {
            url: "<?= url('api/organisasis') ?>",
            dataType: 'json',
            data: function (params) {
                var query = {
                    q: params.term,                                           
                    level: '0'
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

    $('#opd_asal, #opd_tujuan').on('change', () => {
        $('[type=submit]').removeAttr('disabled','disabled')
        if ($('#opd_asal').select2('val') === $('#opd_tujuan').select2('val')) {
            swal.fire({
                type: 'error',
                text: 'OPD asal dan tujuan tidak boleh sama!!'                
            })

            $('[type=submit]').attr('disabled','disabled')
        }
    })

    new inlineDatepicker(document.getElementById('tgl_bast'), {
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

    const doSave = (isDraft) => {

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
                let formData = new FormData($('#form-mutasi')[0])

                formData.append(`opd_asal`, <?= Auth::user()->pid_organisasi ?>)

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
                    
                    formData.append(`dokumen_metadata_id_mutasi[${index}]`, <?= isset($inventaris) ? $inventaris->id: 'null' ?>)
                }

                formData.append('data-detil', JSON.stringify($("#table-detil-mutasi").DataTable().rows().data().toArray()));
                formData.append('draft', isDraft ? '1' : '')

                __ajax({
                    method: 'POST',
                    url: "<?= url('api/mutasis', isset($mutasi) ? [$mutasi->id] : []) ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                }).then((d, resp) => {
                    swal.fire({
                        type: "success",
                        text: "Berhasil menyimpan data!",
                        onClose: () => {
                            window.location = `${$('[base-path]').val()}/mutasis`
                        }
                    })
                    
                })
            }
        })
        
    }

    const form = document.querySelector('#form-mutasi')
    form.addEventListener('submit', (ev) => {
        ev.preventDefault()

        doSave(false)            
    })

    funcGetDokumenFileList()


    editor = new $.fn.dataTable.Editor( {         
        table: "#table-detil-mutasi",
        fields: [ {
                label: "Inventaris:",
                name: "inventaris",
                type: "select"
            }
        ]
    });

    let buttonsOpt = [
        { extend: "create", editor: editor },
        { extend: "remove", editor: editor },
    ]

    let editorInit = false
    let DTE_Field_inventaris = null

    editor.on( 'open', function ( e, type ) {
        
        $('#DTE_Field_inventaris').val('')
        
        if (DTE_Field_inventaris == null) {
            DTE_Field_inventaris = new lookupTable(document.getElementById('DTE_Field_inventaris'),{
                dataTableOption: {
                    ajax: {
                        url: `${$('[base-path]').val()}/inventaris`,
                        method: 'GET',
                        headers: {
                            'Authorization':'Bearer ' + sessionStorage.getItem('api token'),
                        }
                    },
                    cache: true,
                    columns: [
                        {
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
    } );


    editor.on( 'preSubmit', function ( e, data, action ) {
        if(DTE_Field_inventaris.selectedValues.length <= 0) {
            this.field('inventaris').error( 'Mohon pilih inventaris terlebih dahulu!' );
        }

        if ( this.inError() ) {
            return false;
        }

        
        dataSelect = DTE_Field_inventaris.selectedValues
        if (action == 'create') {
            dataSelect.forEach((dataVal, index) => {

                if (data.data[index] == undefined) {
                    data.data[index] = {
                        inventaris: parseInt( dataVal.id ),
                        inventarisNama: dataVal.nama_rek_aset
                    }
                } else {
                    data.data[0].inventaris = parseInt( dataVal.id );
                    data.data[0].inventarisNama = dataVal.nama_rek_aset;
                }
                
            })
            
        } else {
            $.each( data.data, function ( key, values ) {
                data.data[ key ][ 'inventaris' ] = parseInt( dataSelect[0].id );
                data.data[ key ][ 'inventarisNama' ] = dataSelect[0].nama_rek_aset;
            } );
        }
            
        
    } );

    editor.on( 'initEdit', function ( e, node, data) {
        

        setTimeout(() => {
            __ajax({
                url: "<?= url('api/inventaris') ?>/" + data.inventaris,
                method: 'GET',
                dataType: 'json'
            }).then((d) => {
                DTE_Field_inventaris.setDefault(d)                
            })
        }, 1);
            
        
    } );

    editor.on( 'postSubmit', function ( e, node, data) {
        
        DTE_Field_inventaris.setDefault(null)                                
    } );
</script>

@if(isset($mutasi)) 
<script>
buttonsOpt = [
    { extend: "create", editor: editor },
]
</script>
@endif


<script>
    $('#table-detil-mutasi').DataTable({
        buttons: buttonsOpt,
        data: dataDetils,
        dom: 'Bfrtip',
        searching: false,
        "lengthChange": false,
        "ordering": true,
        "aaSorting": [[ 0, "desc" ]],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        columns: [
            {
                data: null,
                defaultContent: '',
                className: 'select-checkbox',
                orderable: false,
                width: 20,
            },
            {
                data: 'inventarisNama',
                title: 'Barang',
                orderable: false,
            }
        ]
    })

    App.Helpers.defaultSelect2($('#opd_asal'), "<?= url('api/organisasis', [Auth::user()->pid_organisasi]) ?>","id","nama")

</script>

@if(isset($mutasi))
<script>
    App.Helpers.defaultSelect2($('#opd_asal'), "<?= url('api/organisasis', [$mutasi->opd_asal]) ?>","id","nama")
    App.Helpers.defaultSelect2($('#opd_tujuan'), "<?= url('api/organisasis', [$mutasi->opd_tujuan]) ?>","id","nama")
</script>
@endif
@endsection