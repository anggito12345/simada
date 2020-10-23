@if(!isset($isInventarisPage))
<!-- pid Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('pidinventaris', 'Inventaris:') !!}
    {!! Form::text('pidinventaris', null, ['id' => 'pidinventaris_pemeliharaan', 'class' => 'form-control']) !!}
</div>
@endif

<!-- Tgl Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('tgl', 'Tanggal Buku Pemeliharaan:') !!}
    {!! Form::text('tgl', null, ['class' => 'form-control','id'=>'tgl']) !!}
</div>

<!-- Uraian Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('uraian', 'Uraian Pemeliharaan:') !!}
    {!! Form::textarea('uraian', null, ['class' => 'form-control']) !!}
</div>

<u class="col-md-12 no-padding">Yang memelihara:</u>

<div class="col-md-12">
    <!-- Persh Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('persh', 'Nama instansi/CV/PT:') !!}
        {!! Form::text('persh', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Alamat Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('alamat', 'Alamat:') !!}
        {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
    </div>
</div>


<u class="col-md-12 no-padding">Surat Perjanjian/Kontrak:</u>

<div class="col-md-12">
    <!-- Nokontrak Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('nokontrak', 'Nomor:') !!}
        {!! Form::text('nokontrak', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Tglkontrak Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('tglkontrak', 'Tanggal:') !!}
        {!! Form::text('tglkontrak', null, ['class' => 'form-control','id'=>'tglkontrak']) !!}
    </div>
</div>

<!-- Biaya Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('biaya', 'Biaya Pemeliharaan:') !!}
    {!! Form::text('biaya', null, ['class' => 'form-control']) !!}
</div>

<!-- Umur Ekonomis Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('umur_ekonomis', 'Umur Ekonomis:') !!}
    {!! Form::number('umur_ekonomis', 0, [ 'class' => 'form-control']) !!}
</div>

<!-- Menambah Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('menambah', 'Menambah Aset:') !!}
    {!! Form::checkbox('menambah', 0, [ 'class' => 'form-control', 'value' => 1]) !!} Ya
</div>

<!-- Keterangan Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Media Field -->
<div class="form-group col-md-12">
    {!! Form::label('media', 'Media:') !!}
    {!! Form::file('media', ['class' => 'form-control', 'name' => 'media']) !!}
</div>

{!! Form::hidden('draft', '', []) !!}

<div class="form-group col-sm-6">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    @if(isset($pemeliharaan) && !empty($pemeliharaan->draft) || !isset($pemeliharaan))
    <div class="btn btn-info" onclick="doSave(true)">Draft</div>
    @endif
    <a href="{!! route('pemeliharaans.index') !!}" class="btn btn-default">Batal</a>
</div>

@section('scripts')
<script src="<?= url('js/thirdparty/dataTables.editor.min.js') ?>"></script>

<script type="text/javascript">


new inlineDatepicker(document.getElementById('tglkontrak'), {
    format: 'DD-MM-YYYY',
    buttonClear: true,
});

if ($("#pidinventaris_pemeliharaan").length > 0) {
    $("#pidinventaris_pemeliharaan").LookupTable({
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
                autoClose: false
            }
        }
    })
}

const mediaPemeliharaan = new FileGallery(document.getElementById('media'), {
    title: 'Media',
    maxSize: 50000000,
    accept: "image/*|video/*",
    onDelete: () => {
        return new Promise((resolve, reject) => {
            let checkIfIdExist = mediaPemeliharaan.checkedRow().filter((d) => {
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
                onPemeliharaanGetFiles(checkIfIdExist[0].foreign_id, () => {})
            })
        })
    }
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
            let formData = new FormData($('#form-pemeliharaan')[0]);

            mediaPemeliharaan.fileList().forEach((d, index) => {
                if (d.rawFile) {
                    formData.append(`media_pemeliharaan[${index}]`, d.rawFile)
                } else {
                    formData.append(`media_pemeliharaan[${index}]`, false)
                }

                let keys = Object.keys(d)

                keys.forEach((key) => {
                    if (key == 'rawFile') {
                        return
                    }
                    formData.append(`media_pemeliharaan_metadata_${key}[${index}]`, d[key])
                })

                // formData.append(`media_pemeliharaan_metadata_id_inventaris[${index}]`, $("#table-inventaris").DataTable().rows('.selected').data()[0].id)
                return d.rawFile
            });

            formData.append('draft', isDraft ? '1' : '');

            __ajax({
                method: 'POST',
                url: "<?= url('api/pemeliharaans', isset($pemeliharaan) ? [$pemeliharaan->id] : []) ?>",
                data: formData,
                processData: false,
                contentType: false,
            }).then((d, resp) => {
                swal.fire({
                    type: "success",
                    text: "Berhasil menyimpan data!",
                    onClose: () => {
                        window.location = `${$('[base-path]').val()}/pemeliharaans`
                    }
                });
            });
        }
    });
};

document.querySelector('#form-pemeliharaan').addEventListener('submit', (e) => {
    e.preventDefault()
    doSave(false)
})

$(document).ready(() => {
    var url_string = window.location.href; //window.location.href
    var url = new URL(url_string);
    var idinventaris = url.searchParams.get("idinventaris");
    var tgldibukukan = url.searchParams.get("tgldibukukan");
    var biaya = url.searchParams.get("hargasatuan");
    if (idinventaris) {
        $("#pidinventaris_pemeliharaan").LookupTable().setValAjax("<?= url('api/inventaris') ?>/"+idinventaris).then((d) => {
        })
    }

    if (tgldibukukan) {
        $('#tgl').val(tgldibukukan)
    }

    new inlineDatepicker(document.getElementById('tgl'), {
        format: 'DD-MM-YYYY',
        buttonClear: true,
    });

    if (biaya) {
        $("#biaya").mask("#.##0,00", {reverse: true})
        $("#biaya").val(biaya)
    }

})

</script>

@if(isset($pemeliharaan))
<script>

    $("#pidinventaris_pemeliharaan").LookupTable().setValAjax("<?= url('api/inventaris', [$pemeliharaan->pidinventaris]) ?>").then((d) => {})
</script>
@endif

@endsection

@if(!isset($isInventarisPage))
    @section('scripts')
        @include('pemeliharaans.js')
    @endsection
@else
    @include('pemeliharaans.js')
@endif
