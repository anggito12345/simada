<!-- No Spk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_spk', 'No SPK:') !!}
    {!! Form::text('no_spk', null, ['class' => 'form-control']) !!}
</div>

<!-- Nilai Kontrak Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nilai_kontrak', 'Nilai Kontrak:') !!}
    {!! Form::text('nilai_kontrak', null, ['class' => 'form-control']) !!}
</div>

<!-- No Bast Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_bast', 'No BASK:') !!}
    {!! Form::text('no_bast', null, ['class' => 'form-control']) !!}
</div>

<!-- Dokumen Field -->
<div class="form-group col-sm-12">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::file('dokumen', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    <table id="table-detil-rka" class="table table-striped ">
        <thead>
        </thead>
    </table>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-6">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if ((isset($rka) && !empty($rka->draft)) || !isset($rka))
        <div class="btn btn-info" onclick="doSave(true)">Draft</div>
    @endif
    <a href="{!! route('rkas.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script src="<?= url('js/thirdparty/dataTables.editor.min.js') ?>"></script>

<?php
    $dataDetils = json_encode([]);
    if(isset($rka)) {
        $dataDetils = json_encode(\App\Models\rka_detil::where('pid', $rka->id)
            ->select('*')
            //->join('m_barang','m_barang.id', 'rka_detil.kode_barang')
            ->get());
    }

?>

<script>
let dataDetils = JSON.parse('<?= $dataDetils ?>')

const funcGetDokumenFileList = () => {
    __ajax({
        method: 'GET',
        url: "<?= url('api/system_uploads') ?>",
        data: {
            jenis: 'dokumen',
            foreign_field: 'id',
            foreign_id: <?= isset($rka) ? $rka->id : 'null' ?>,
            foreign_table: 'rka',
        },
    }).then((files) => {
        fileGallery.fileList(files)
    })
}

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
        html: ``,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!'
    }).then((result) => {
        if (result.value) {
            let formData = new FormData($('#form-rka')[0])

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

                formData.append(`dokumen_metadata_id_rka[${index}]`, <?= isset($rka) ? $rka->id: 'null' ?>)
            }

            formData.append('data-detil', JSON.stringify($("#table-detil-rka").DataTable().rows().data().toArray()));
            formData.append('draft', isDraft ? '1' : '')

            __ajax({
                method: 'POST',
                url: "<?= url('api/rkas', isset($rka) ? [$rka->id] : []) ?>",
                data: formData,
                processData: false,
                contentType: false,
            }).then((d, resp) => {
                swal.fire({
                    type: "success",
                    text: "Berhasil menyimpan data!",
                    onClose: () => {
                        window.location = `${$('[base-path]').val()}/rkas`
                    }
                })

            })
        }
    })

}

const form = document.querySelector('#form-rka')
form.addEventListener('submit', (ev) => {
    ev.preventDefault()

    doSave(false)
})

funcGetDokumenFileList()

editor = new $.fn.dataTable.Editor( {
    table: "#table-detil-rka",
    fields: [ {
            label: "Kode Barang:",
            name: "kode_barang",
            type: "select"
        }, {
            label: "Nama Barang:",
            name: "nama_barang",
            attr: {
                readonly: "readonly",
                type: "text"
            }
        }, {
            label: "Jumlah RKA:",
            name: "jumlah_rencana",
            attr: {
                readonly: "readonly",
                type: "number"
            }
        }, {
            label: "Harga Satuan RKA:",
            name: "harga_satuan_rencana",
            attr: {
                readonly: "readonly",
                type: "number"
            }
        }, {
            label: "Nilai RKA:",
            name: "total_rencana",
            attr: {
                readonly: "readonly",
                type: "number"
            }
        }, {
            label: "Jumlah Real:",
            name: "jumlah_real",
            attr: {
                type: "number"
            }
        }, {
            label: "Harga Satuan Real:",
            name: "harga_satuan_real",
            attr: {
                type: "number"
            }
        }, {
            label: "Nilai Kontrak:",
            name: "nilai_kontrak",
            attr: {
                type: "number"
            }
        }, {
            label: "KIB:",
            name: "kib",
            type: "select"
        }, {
            label: "Keterangan:",
            name: "keterangan",
            type: "textarea"
        },

    ]
});

let buttonsOpt = [
    { extend: "create", editor: editor },
    { extend: "edit", editor: editor },
    { extend: "remove", editor: editor },
]

</script>

@if(isset($rka))
<script>
buttonsOpt = [
    { extend: "create", editor: editor },
]
</script>
@endif

<script>


let editorInit = false

editor.on( 'open', function ( e, type ) {
    $('#DTE_Field_kode_barang').val('').trigger('change')
    // Type is 'main', 'bubble' or 'inline'
    if (!editorInit) {
        $('#DTE_Field_kode_barang').select2({
            ajax: {
                url: "<?= url('api/rka_barangs') ?>",
                dataType: 'json',
                headers: {
                    'Authorization':'Bearer ' + sessionStorage.getItem('api token'),
                },
                data: function (params) {
                    var query = {
                        q: params.term,
                    }
                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = d.kode_barang,
                            $('#DTE_Field_nama_barang').val(d.nama_barang),
                            $('#DTE_Field_jumlah_rencana').val(d.jumlah),
                            $('#DTE_Field_harga_satuan_rencana').val(d.harga_satuan),
                            $('#DTE_Field_total_rencana').val(d.nilai)
                            return d
                        })
                    };
                }
            },
            theme: 'bootstrap' ,
        })
        editorInit = true
    }

} );


editor.on( 'preSubmit', function ( e, data, action ) {
    if(! $('#DTE_Field_kode_barang').select2('val')) {
        this.field('kode_barang').error( 'Mohon pilih Kode Barang terlebih dahulu!' );
    }

    if(this.field( 'jumlah_real' ).val() == '') {
        this.field('jumlah_real').error( 'Jumlah Realisasi tidak boleh kosong' );
    }

    if(this.field( 'harga_satuan_real' ).val() == '') {
        this.field('harga_satuan_real').error( 'Harga Satuan Realisasi tidak boleh kosong' );
    }

    if(this.field( 'nilai_kontrak' ).val() == '') {
        this.field('nilai_kontrak').error( 'Nilai Kontrak tidak boleh kosong' );
    }

    if(this.field( 'kib' ).val() == '') {
        this.field('kib').error( 'KIB tidak boleh kosong' );
    }

    if ( this.inError() ) {
        return false;
    }

    // Type is 'main', 'bubble' or 'inline'
    dataSelect = $('#DTE_Field_kode_barang').select2('data')[0]
    if (action == 'create') {
        data.data[0].kode_barang = parseInt( dataSelect.id );
        data.data[0].kode_barangNama = dataSelect.text;
    } else {
        $.each( data.data, function ( key, values ) {
            data.data[ key ][ 'kode_barang' ] = parseInt( dataSelect.id );
            data.data[ key ][ 'nama_barang' ] = dataSelect.text;
        } );
    }


} );

editor.on( 'initEdit', function ( e, node, data) {
    // Type is 'main', 'bubble' or 'inline'

    setTimeout(() => {
        App.Helpers.defaultSelect2($('#DTE_Field_kode_barang'), "<?= url('api/rka_barangs') ?>/" + data.kode_barang,"id","nama_rek_aset")
    }, 1);


} );


$('#table-detil-rka').DataTable({
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
        },/*
        {
            data: 'kode_barang',
            title: 'Kode Barang',
            orderable: false,
        }, */
        {
            data: 'nama_barang',
            title: 'Nama Barang',
            orderable: false,
        },/*
        {
            data: 'jumlah_rencana',
            title: 'Jumlah RKA',
            orderable: false,
        },
        {
            data: 'harga_satuan_rencana',
            title: 'Harga Satuan RKA',
            orderable: false,
        },
        {
            data: 'nilai_rencana',
            title: 'Nilai RKA',
            orderable: false,
        }, */
        {
            data: 'jumlah_real',
            title: 'Jumlah',
            orderable: false,
        },
        {
            data: 'harga_satuan_real',
            title: 'Harga Satuan',
            orderable: false,
        },
        {
            data: 'nilai_kontrak',
            title: 'Nilai Kontrak',
            orderable: false,
        },
        {
            data: 'kib',
            title: 'KIB',
            orderable: false,
        },
        {
            data: 'keterangan',
            title: 'Keterangan',
            className: 'keterangan',
            orderable: false,
        },
    ],
})

</script>
@endsection
