<!-- No surat -->
<div class="form-group col-sm-6">
    {!! Form::label('nosurat', 'No Surat:') !!}
    {!! Form::text('nosurat', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl surat -->
<div class="form-group col-6">
    {!! Form::label('tglsurat', 'Tgl Surat:') !!}
    {!! Form::text('tglsurat', null, ['class' => 'form-control', 'id'=>'tglsurat']) !!}
</div>

<!-- Dokumen -->
<div class="form-group col-6">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::file('dokumen', ['class' => 'form-control', 'id' => 'dokumen']) !!}
</div>

<div class="form-group col-sm-12">
    <table id="table-detil-reklas" class="table table-striped">
        <thead>
        </thead>
    </table>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-6">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    @if ((isset($reklas) && !empty($reklas->draft)) || !isset($reklas))
        <div class="btn btn-info" onclick="doSave(true)">Draft</div>
    @endif
    <a href="{!! route('reklas.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script src="<?= url('js/thirdparty/dataTables.editor.min.js') ?>"></script>

<script type="text/javascript">

let kodeAwalTemp, kodeTujuanTemp = null;

new inlineDatepicker(document.getElementById('tglsurat'), {
    format: 'DD-MM-YYYY',
    buttonClear: true,
});

document.querySelector('#form-reklas').addEventListener('submit', (e) => {
    e.preventDefault();
    doSave(false);
});

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
            let formData = new FormData($('#form-reklas')[0]);

            if (document.getElementById('dokumen').files.length > 0) {
                formData.append('dokumen[]', document.getElementById('dokumen').files[0])
            }

            formData.append('data-detil', JSON.stringify($("#table-detil-reklas").DataTable().rows().data().toArray()));
            formData.append('draft', isDraft ? '1' : '');

            __ajax({
                method: 'POST',
                url: "<?= url('api/reklas', isset($reklas) ? [$reklas->id] : []) ?>",
                data: formData,
                processData: false,
                contentType: false,
            }).then((d, resp) => {
                swal.fire({
                    type: "success",
                    text: "Berhasil menyimpan data!",
                    onClose: () => {
                        window.location = `${$('[base-path]').val()}/reklas`
                    }
                })
            });
        }
    });
};

const editor = new $.fn.dataTable.Editor({         
    table: "#table-detil-reklas",
    fields: [
        {
            label: "Kode Awal:",
            name: "kode_awal",
            type: "select"
        },
        {
            label: "Kode Tujuan:",
            name: "kode_tujuan",
            type: "select"
        },
    ]
});

let buttonsOpt = [
    { extend: "create", editor: editor },
    { extend: "remove", editor: editor },
];

let editorInit = false

editor.on('open', (e, type) => {
    $('#DTE_Field_kode_awal, #DTE_Field_kode_tujuan').val('').trigger('change')

    // Type is 'main', 'bubble' or 'inline'
    if (!editorInit) {
        $('#DTE_Field_kode_awal').select2({
            ajax: {
                url: "<?= url('api/inventaris?is_exist_reklas=1') ?>",
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
                            d.text = `${viewModel.helpers.buildKodeBarang(d)} - ${d.nama_rek_aset}`;
                            return d
                        })
                    };
                }
            },
            theme: 'bootstrap' ,
        });

        $('#DTE_Field_kode_tujuan').select2({
            ajax: {
                url: "<?= url('api/barangs/get?length=10') ?>",
                dataType: 'json',
                headers: {
                    'Authorization':'Bearer ' + sessionStorage.getItem('api token'),
                },
                data: function (params) {
                    params['search-lookup'] = {
                        "nama_rek_aset": {
                            operator: 'like',
                            value: params.term === undefined ? '' : params.term,
                            logic: 'or',
                            group: 'filter'
                        },
                        "CONCAT(kode_akun,'.',kode_kelompok,'.',kode_jenis,'.',kode_objek,'.', kode_rincian_objek, '.', kode_sub_rincian_objek,'.',kode_sub_sub_rincian_objek)": {
                            operator: 'like',
                            value: params.term === undefined ? '' : params.term,
                            logic: 'or',
                            group: 'filter'
                        },
                    }

                    return params;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data.map((d) => {
                            d.text = `${viewModel.helpers.buildKodeBarang(d)} - ${d.nama_rek_aset}`;
                            return d
                        })
                    };
                }
            },
            theme: 'bootstrap' ,
        });


        editorInit = true
    }
});

editor.on('preSubmit', (e, data, action) => {
    const kodeAwalEl = $('#DTE_Field_kode_awal');
    const kodeTujuanEl = $('#DTE_Field_kode_tujuan');

    if (kodeAwalEl.length > 0 && !kodeAwalEl.select2('val')) {
        editor.field('kode_awal').error( 'Mohon pilih Kode Awal terlebih dahulu!' );
    }

    if (kodeTujuanEl.length > 0 && !kodeTujuanEl.select2('val')) {
        editor.field('kode_tujuan').error( 'Mohon pilih Kode Tujuan terlebih dahulu!' );
    }

    if (editor.inError()) {
        return false;
    }

    const kodeAwal = kodeAwalEl.length > 0 ? kodeAwalEl.select2('data')[0] : null;
    const kodeTujuan = kodeTujuanEl.length > 0 ? kodeTujuanEl.select2('data')[0] : null;

    if (action == 'create') {
        data.data[0].kode_awal = parseInt(kodeAwal.id);
        data.data[0].kode_awalNama = kodeAwal.text;

        data.data[0].kode_tujuan = parseInt(kodeTujuan.id);
        data.data[0].kode_tujuanNama = kodeTujuan.text;
    } else {
        $.each(data.data, (key, values) => {
            if (kodeAwal != null) {
                data.data[key]['kode_awal'] = parseInt(kodeAwal.id);
                data.data[key]['kode_awalNama'] = kodeAwal.text;
            } else {
                data.data[key]['kode_awal'] = kodeAwalTemp;
            }

            if (kodeTujuan != null) {
                data.data[key]['kode_tujuan'] = parseInt(kodeTujuan.id);
                data.data[key]['kode_tujuanNama'] = kodeTujuan.text;
            } else {
                data.data[key]['kode_tujuan'] = kodeTujuanTemp;
            }
        });
    }
} );

const detailTable = $('#table-detil-reklas').DataTable({
    buttons: buttonsOpt,
    data: [],
    dom: 'Bfrtip',
    searching: false,
    "lengthChange": false,
    "ordering": true,
    "aaSorting": [[ 0, "desc" ]],
    autoWidth: false, //step 1
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
            width: 15,
        },
        {
            data: 'kode_awalNama',
            editField: 'kode_awal',
            title: 'Kode Awal',
            orderable: false,
            width: '250px',
        },
        {
            data: 'kode_tujuanNama',
            editField: 'kode_tujuan',
            title: 'Kode Tujuan',
            orderable: false,
            width: '250px',
        },
    ],
});

$('#table-detil-reklas').on('click', 'tbody td:not(:first-child)', function () {
    editor.inline(this);
});

editor.on('initEdit', (e, node, data, items, type) => {
    kodeAwalTemp = data.kode_awal;
    kodeTujuanTemp = data.kode_tujuan;

    setTimeout(() => {
        App.Helpers.defaultSelect2($('#DTE_Field_kode_awal'), "<?= url('api/inventaris') ?>/" + data.kode_awal, "id", "nama_kode_barang_formated");
        App.Helpers.defaultSelect2($('#DTE_Field_kode_tujuan'), "<?= url('api/barangs') ?>/" + data.kode_tujuan, "id", "nama_kode_barang_formated");
    }, 1);
});


</script>
@endsection