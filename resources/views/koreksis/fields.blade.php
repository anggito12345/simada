<div class="form-group col-sm-12">
    <table id="table-detil-koreksi" class="table table-striped">
        <thead>
        </thead>
    </table>
</div>

<!-- Tgl Koreksi -->
<div class="form-group col-6">
    {!! Form::label('tglkoreksi', 'Tgl Koreksi:') !!}
    {!! Form::text('tglkoreksi', null, ['class' => 'form-control', 'id'=>'tglkoreksi']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-6">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    @if ((isset($koreksi) && !empty($koreksi->draft)) || !isset($koreksi))
        <div class="btn btn-info" onclick="doSave(true)">Draft</div>
    @endif
    <a href="{!! route('koreksis.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script src="<?= url('js/thirdparty/dataTables.editor.min.js') ?>"></script>
<script src="<?= url('js/thirdparty/jquery.number.min.js') ?>"></script>

<script type="text/javascript">

let pidinventarisTemp, koderekTemp = null;

new inlineDatepicker(document.getElementById('tglkoreksi'), {
    format: 'DD-MM-YYYY',
    buttonClear: true,
});

document.querySelector('#form-koreksi').addEventListener('submit', (e) => {
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
            let formData = new FormData($('#form-koreksi')[0]);            

            formData.append('data-detil', JSON.stringify($("#table-detil-koreksi").DataTable().rows().data().toArray()));
            formData.append('draft', isDraft ? '1' : '');

            __ajax({
                method: 'POST',
                url: "<?= url('api/koreksis', isset($koreksi) ? [$koreksi->id] : []) ?>",
                data: formData,
                processData: false,
                contentType: false,
            }).then((d, resp) => {
                swal.fire({
                    type: "success",
                    text: "Berhasil menyimpan data!",
                    onClose: () => {
                        window.location = `${$('[base-path]').val()}/koreksis`
                    }
                })
            });
        }
    });
};

const editor = new $.fn.dataTable.Editor({         
    table: "#table-detil-koreksi",
    fields: [
        {
            label: "Kode Rek:",
            name: "pidinventaris",
            type: "select"
        },
        {
            label: "Nama Rek:",
            name: "nama_rek",
            type: "readonly",
            def: '',
        },
        {
            label: "Nilai Lama:",
            name: "nilai_lama",
            type: "text",
            def: '',
        },
        {
            label: "Nilai Baru:",
            name: "nilai_baru",
            type: 'text'
        },
    ]
});

let buttonsOpt = [
    { extend: "create", editor: editor },
    { extend: "remove", editor: editor },
];

let editorInit = false

editor.on('open', (e, type) => {
    $('#DTE_Field_pidinventaris, #DTE_Field_nama_rek, #DTE_Field_nilai_lama, #DTE_Field_nilai_baru').val('').trigger('change');
    $('#DTE_Field_nilai_lama').attr('readonly', true);

    $('#DTE_Field_nilai_baru').unmask();
    $('#DTE_Field_nilai_baru').mask("#.##0", {reverse: true});

    if (!editorInit) {
        $('#DTE_Field_pidinventaris').select2({
            ajax: {
                url: "<?= url('api/inventaris') ?>",
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
                            d.text = `${viewModel.helpers.buildKodeBarang(d)}`;

                            return d;
                        })
                    };
                }
            },
            theme: 'bootstrap' ,
        });

        $('#DTE_Field_pidinventaris').on('select2:select', (e) => {
            $('#DTE_Field_nama_rek').val(e.params.data.nama_rek_aset);
            $('#DTE_Field_nilai_lama').val(e.params.data.harga_satuan);

            $('#DTE_Field_nilai_lama').unmask();
            $('#DTE_Field_nilai_lama').mask("#.##0", {reverse: true});
        });

        $('#DTE_Field_pidinventaris').on('select2:clear', (e) => {
            $('#DTE_Field_pidinventaris, #DTE_Field_nama_rek, #DTE_Field_nilai_lama, #DTE_Field_nilai_baru').val('').trigger('change');
        });

        editorInit = true
    }
});

editor.on('preSubmit', (e, data, action) => {
    const koderekEl = $('#DTE_Field_pidinventaris');
    const nilaibaruEl = $('#DTE_Field_nilai_baru');

    if (koderekEl.length > 0 && !koderekEl.select2('val')) {
        editor.field('kode_rek').error('Mohon pilih Kode Rek terlebih dahulu!');
    }

    if (Object.keys(nilaibaruEl).length != 0 && nilaibaruEl.val().length == 0) {
        editor.field('nilai_baru').error('Mohon isi Nilai Baru terlebih dahulu!');
    }

    if (editor.inError()) {
        return false;
    }

    const kodeRek = koderekEl.length > 0 ? koderekEl.select2('data')[0] : null;

    if (action == 'create') {
        data.data[0].pidinventaris = parseInt(kodeRek.id);
        data.data[0].kode_rek = kodeRek.text;
    } else {
        $.each(data.data, (key, values) => {
            if (kodeRek != null) {
                data.data[key]['pidinventaris'] = parseInt(kodeRek.id);
                data.data[key]['kode_rek'] = kodeRek.text;
                data.data[key]['nama_rek'] = kodeRek.nama_rek_aset;
                data.data[key]['nilai_lama'] = $.number(kodeRek.harga_satuan, 0, ',', '.');
            } else {
                data.data[key]['pidinventaris'] = pidinventarisTemp;
                data.data[key]['kode_rek'] = koderekTemp;
            }
        });
    }
});

const detailTable = $('#table-detil-koreksi').DataTable({
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
            data: 'kode_rek',
            editField: 'pidinventaris',
            title: 'Kode Rek',
            orderable: false,
            width: '150px',
        },
        {
            data: 'nama_rek',
            editField: 'nama_rek',
            title: 'Nama Rek',
            orderable: false,
            width: '250px',
        },
        {
            data: 'nilai_lama',
            editField: 'nilai_lama',
            title: 'Nilai Lama',
            orderable: false,
            width: '100px',
        },
        {
            data: 'nilai_baru',
            editField: 'nilai_baru',
            title: 'Nilai Baru',
            orderable: false,
            width: '100px',
        },
    ],
});

$('#table-detil-koreksi').on('click', 'tbody td:nth-child(2), tbody td:nth-child(5)', function () {
    editor.inline(this);
});

editor.on('initEdit', (e, node, data, items, type) => {
    pidinventarisTemp = data.pidinventaris;
    koderekTemp = data.kode_rek;

    setTimeout(() => {
        $('#DTE_Field_nilai_baru').val(data.nilai_baru)
        App.Helpers.defaultSelect2($('#DTE_Field_pidinventaris'), "<?= url('api/inventaris') ?>/" + data.pidinventaris, "id", "kode_barang");
    }, 1);
});

</script>
@endsection