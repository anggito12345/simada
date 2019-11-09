
<!--  Field -->

<div class="form-group col-md-12">    
    {!! Form::label('kodebarang', 'Nama barang:') !!}
    <div class="row">
        <div class="col-md-4">
            {!! Form::text('kodebarang', null, ['class' => 'form-control', 'readonly' => 'readonly', 'data-bind' => 'value: viewModel.data.formPenghapusan().kode_barang']) !!}
        </div>
        <div class="col-md-8">
            {!! Form::text('namabarang', null, ['class' => 'form-control', 'readonly' => 'readonly', 'data-bind' => 'value: viewModel.data.formPenghapusan().nama_rek_aset']) !!}
        </div>
    </div>
</div>

<div class="form-group col-md-12">
    {!! Form::label('noreg', 'Nomor register:') !!}
    {!! Form::text('noreg', null, ['class' => 'form-control', 'readonly' => 'readonly', 'data-bind' => 'value: viewModel.data.formPenghapusan().noreg']) !!}
</div>

<!-- Tglhapus Field -->
<div class="form-group col-md-12">
    {!! Form::label('tglhapus', 'Tanggal Penghapusan:') !!}
    {!! Form::text('tglhapus', null, ['class' => 'form-control','id'=>'tglhapus', 'data-bind' => 'input: viewModel.data.formPenghapusan().tglhapus']) !!}
</div>

<!-- Kriteria Field -->
<div class="form-group col-md-12">
    {!! Form::label('kriteria', 'Kriteria Penghapusan:') !!}
    {!! Form::select('kriteria', [
        'Pemindahtanganan'  =>  'Pemindahtanganan',
        'Pemusnahan' => 'Pemusnahan',
        'Penghapusan' => 'Penghapusan'
    ], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().kriteria']) !!}
</div>

<!-- Kondisi Field -->
<div class="form-group col-md-12">
    {!! Form::label('kondisi', 'Kondisi Akhir Barang:') !!}
    {!! Form::select('kondisi', \App\Models\BaseModel::$kondisiDs ,null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().kondisi']) !!}
</div>

<!-- Harga Apprisal Field -->
<div class="form-group col-md-12">
    {!! Form::label('harga_apprisal', 'Harga Appraisal:') !!}
    {!! Form::number('harga_apprisal', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().harga_apprisal']) !!}
</div>

<!-- Dokumen Field -->
<div class="form-group col-md-12">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::file('dokumen', ['class' => 'form-control', 'name' => 'dummy-dokumen']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-md-12">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::file('foto', ['class' => 'form-control', 'name' => 'dummy-foto']) !!}
</div>

<label>Dasar SK Gurbenur</label>

<!-- Nosk Field -->
<div class="form-group col-md-12">
    {!! Form::label('nosk', 'No:') !!}
    {!! Form::text('nosk', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().nosk']) !!}
</div>

<!-- Tglsk Field -->
<div class="form-group col-md-12">
    {!! Form::label('tglsk', 'Tanggal:') !!}
    {!! Form::text('tglsk', null, ['class' => 'form-control','id'=>'tglsk', 'data-bind' => 'value: viewModel.data.formPenghapusan().tglsk']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-md-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPenghapusan().keterangan']) !!}
</div>

<!-- Submit Field -->
<!-- <div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('penghapusans.index') !!}" class="btn btn-default">Cancel</a>
</div> -->


<script>
    var fileGallery, foto
    viewModel.jsLoaded.subscribe(() => {
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
    })
</script>