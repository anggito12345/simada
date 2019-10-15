<!-- Peruntukan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('peruntukan', 'Peruntukan:') !!}
    {!! Form::text('peruntukan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().peruntukan']) !!}
</div>

<!-- Umur Field -->
<div class="form-group col-sm-12">
    {!! Form::label('umur', 'Umur:') !!}
    {!! Form::number('umur', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().umur']) !!}
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
    {!! Form::text('tgl_akhir', null, ['class' => 'form-control','id'=>'tgl_akhir', 'data-bind' => 'value: viewModel.data.formPemanfaatan().tgl_akhir']) !!}
</div>

<!-- Mitra Field -->
<div class="form-group col-sm-12">
    {!! Form::label('mitra', 'Mitra:') !!}
    {!! Form::number('mitra', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().mitra']) !!}
</div>

<!-- Tipe Kontribusi Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tipe_kontribusi', 'Tipe Kontribusi:') !!}
    {!! Form::text('tipe_kontribusi', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().tipe_kontribusi']) !!}
</div>

<!-- Jumlah Kontribusi Field -->
<div class="form-group col-sm-12">
    {!! Form::label('jumlah_kontribusi', 'Jumlah Kontribusi:') !!}
    {!! Form::number('jumlah_kontribusi', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().jumlah_kontribusi']) !!}
</div>

<!-- Pegawai Field -->
<div class="form-group col-sm-12">
    {!! Form::label('pegawai', 'Pegawai:') !!}
    {!! Form::number('pegawai', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemanfaatan().pegawai']) !!}
</div>

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
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pemanfaatans.index') !!}" class="btn btn-default">Cancel</a>
</div> -->
<script>
    var fileGalleryPemanfaatan, fotoPemanfaatan
    viewModel.jsLoaded.subscribe(() => {
        new inlineDatepicker(document.getElementById('tgl_mulai'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });

        new inlineDatepicker(document.getElementById('tgl_akhir'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
            value: viewModel.data.formPemanfaatan().tglhapus
        });
        

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
    })
</script>