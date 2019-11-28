@if(!isset($isInventarisPage))
<!-- pid Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('pidinventaris', 'Inventaris:') !!}
    {!! Form::text('pidinventaris', null, ['id' => 'pidinventaris_pemeliharaan', 'class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().pidinventaris']) !!}
</div>

<script>
    viewModel.data.formPemeliharaan = ko.observable({})
</script>
@endif

<!-- Tgl Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('tgl', 'Tanggal Buku Pemeliharaan:') !!}
    {!! Form::text('tgl', null, ['class' => 'form-control','id'=>'tgl', 'data-bind' => 'value: viewModel.data.formPemeliharaan().tgl']) !!}
</div>

<!-- Uraian Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('uraian', 'Uraian Pemeliharaan:') !!}
    {!! Form::textarea('uraian', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().uraian']) !!}
</div>

<u class="col-md-12 no-padding">Yang memelihara:</u>

<div class="col-md-12">
    <!-- Persh Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('persh', 'Nama instansi/CV/PT:') !!}
        {!! Form::text('persh', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().persh']) !!}
    </div>

    <!-- Alamat Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('alamat', 'Alamat:') !!}
        {!! Form::text('alamat', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().alamat']) !!}
    </div>
</div>


<u class="col-md-12 no-padding">Surat Perjanjian/Kontrak:</u>

<div class="col-md-12">
    <!-- Nokontrak Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('nokontrak', 'Nomor:') !!}
        {!! Form::text('nokontrak', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().nokontrak']) !!}
    </div>

    <!-- Tglkontrak Field -->
    <div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
        {!! Form::label('tglkontrak', 'Tanggal:') !!}
        {!! Form::text('tglkontrak', null, ['class' => 'form-control','id'=>'tglkontrak', 'data-bind' => 'value: viewModel.data.formPemeliharaan().tglkontrak']) !!}
    </div>
</div>

<!-- Biaya Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('biaya', 'Biaya Pemeliharaan:') !!}
    {!! Form::number('biaya', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().biaya']) !!}
</div>

<!-- Menambah Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('menambah', 'Menambah Aset:') !!}
    {!! Form::checkbox('menambah', 0, [  'class' => 'form-control', 'value' => 1, 'data-bind' => 'checked: viewModel.data.formPemeliharaan().menambah']) !!} Ya
</div>

<!-- Keterangan Field -->
<div class="form-group <?= isset($isInventarisPage) ? 'col-md-12' : 'col-md-6'  ?>">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formPemeliharaan().keterangan']) !!}
</div>

@if(!isset($isInventarisPage))
<div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?> col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('pemeliharaans.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif



<script>
    
    viewModel.jsLoaded.subscribe(() => {
        

        if($("#pidinventaris_pemeliharaan").length > 0 ) {            

            $("#pidinventaris_pemeliharaan").LookupTable({
                DataTable: {
                    ajax: {
                        url: $("[base-path]").val() + "/inventaris",
                        dataSrc: 'data',
                        data: (d) => {
                            return d
                        },
                        headers: {
                            'Authorization':'Bearer ' + sessionStorage.getItem('api token'),
                        }
                    },
                    columns: [
                        { data: 'noreg', title: 'Nomor Registrasi' },
                        { data: 'nama_rek_aset', 'name' : 'm_barang.nama_rek_aset', title: 'Nama Barang' },
                        { data: 'tahun_perolehan', title: 'Tahun Perolehan' },
                        
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

        new inlineDatepicker(document.getElementById('tgl'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });

        new inlineDatepicker(document.getElementById('tglkontrak'), {
            format: 'DD-MM-YYYY',
            buttonClear: true,
        });
        
    })
</script>

@if(isset($pemeliharaan))
<script>
    viewModel.jsLoaded.subscribe(() => {
        $("#pidinventaris_pemeliharaan").LookupTable().setValAjax("<?= url('api/inventaris', [$pemeliharaan->pidinventaris]) ?>").then((d) => {
        })        
    })
</script>
@endif