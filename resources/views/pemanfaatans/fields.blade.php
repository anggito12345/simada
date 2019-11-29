<!-- Peruntukan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('peruntukan', __('field.peruntukan')) !!}
    {!! Form::select('peruntukan', \App\Models\BaseModel::$peruntukanDs , null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().peruntukan']) !!}
</div>

<!-- Umur Field -->
<div class="form-group col-sm-12">
    {!! Form::label('umur', __('field.umur')) !!}
    <div class="input-group">
        {!! Form::number('umur', null, [ 'onchange' => 'changeTanggalAkhir(this)', 'class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().umur']) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2">Hari</span>
        </div>
    </div>

</div>

<!-- No Perjanjian Field -->
<div class="form-group col-sm-12">
    {!! Form::label('no_perjanjian', 'No Perjanjian:') !!}
    {!! Form::text('no_perjanjian', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().no_perjanjian']) !!}
</div>

<!-- Tgl Mulai Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tgl_mulai', 'Tgl Mulai:') !!}
    {!! Form::text('tgl_mulai', null, ['class' => 'form-control','id'=>'tgl_mulai', 'data-bind' => 'value: viewModel.data.formPemanfaatan().tgl_mulai']) !!}
</div>

<!-- Tgl Akhir Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tgl_akhir', 'Tgl Akhir:') !!}
    {!! Form::text('tgl_akhir', null, ['class' => 'form-control','id'=>'tgl_akhir', 'data-bind' => 'value: viewModel.data.formPemanfaatan().tgl_akhir', 'readonly' => 'readonly']) !!}
</div>

<!-- Mitra Field -->
<div class="form-group col-sm-12">
    {!! Form::label('mitra', 'Mitra:') !!}
    {!! Form::select('mitra',[] ,null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().mitra']) !!}
</div>

<!-- Tipe Kontribusi Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tipe_kontribusi', 'Tipe Kontribusi:') !!}
    {!! Form::select('tipe_kontribusi', \App\Models\BaseModel::$tipeKontribusiDs ,null, ['onchange' => 'notifySubscribersManually()', 'class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().tipe_kontribusi']) !!}
</div>

<!-- Tetap Field -->
<!-- ko if: viewModel.data.formPemanfaatan().tipe_kontribusi == '2' -->
<div class="form-group col-sm-12">
    {!! Form::label('tetap', 'Tetap:') !!}
    {!! Form::number('tetap' , "", ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().tetap']) !!}
</div>

<!-- Bagi Hasil Field -->
<div class="form-group col-sm-12">
    {!! Form::label('bagi_hasil', 'Bagi Hasil:') !!}
    {!! Form::number('bagi_hasil', "", ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().bagi_hasil']) !!}
</div>
<!-- /ko -->

<!-- ko if: viewModel.data.formPemanfaatan().tipe_kontribusi != '2' -->
<div class="form-group col-sm-12">
    {!! Form::label('jumlah_kontribusi', 'Jumlah Kontribusi:') !!}
    {!! Form::number('jumlah_kontribusi', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().jumlah_kontribusi']) !!}
</div>
<!-- /ko -->

<!-- Pegawai Field -->
<!-- <div class="form-group col-sm-12">
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

<!-- Submit Field -->
<!-- <div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('pemanfaatans.index') !!}" class="btn btn-default">Batal</a>
</div> -->
<script>
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


    viewModel.jsLoaded.subscribe(() => {
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
        console.log(fileGalleryPemanfaatan)

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
    })
</script>