

<!-- Merk Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('merk', 'Merk:') !!}
    {!! Form::select('merk',[], null, ['class' => 'form-control','id' => 'merk-detilmesin', 'data-bind' => 'value: viewModel.data["KIB B"]().merk']) !!}
</div>

<!-- Ukuran Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('ukuran', 'Ukuran:') !!}
    {!! Form::text('ukuran', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB B"]().ukuran']) !!}
</div>

<!-- Bahan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('bahan', 'Bahan:') !!}
    {!! Form::text('bahan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB B"]().bahan']) !!}
</div>

<!-- Norangka Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('norangka', 'No Rangka:') !!}
    {!! Form::text('norangka', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB B"]().norangka']) !!}
</div>

<!-- Nomesin Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nomesin', 'No Mesin:') !!}
    {!! Form::text('nomesin', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB B"]().nomesin']) !!}
</div>

<!-- Nopol Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nopol', 'Nopol:') !!}
    {!! Form::text('nopol', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB B"]().nopol']) !!}
</div>

<!-- Bpkb Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('bpkb', 'Nomor BPKB:') !!}
    {!! Form::text('bpkb', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB B"]().bpkb']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data["KIB B"]().keterangan']) !!}
</div>

@if(!isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1)
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('detilmesins.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif

<script>

    viewModel.jsLoaded.subscribe(() => {
        $('<?= "#merk-detilmesin" ?>').select2({
            ajax: {
                url: "<?= url('api/merkbarangs') ?>",
                dataType: 'json',
                processResults: function (data) {

                    let options = {
                        id: "-",
                        text: "<div class='text-gray'>Tambah Merk Barang Baru</div>"
                    }
                    

                    data.data.unshift(options)
                    
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data
                    };
                }
            },
            templateResult: function (d) {                 
                return $("<span>"+d.text+"</span>"); 
            },
            templateSelection: function (d) { return $("<span>"+d.text+"</span>"); },
            theme: 'bootstrap' ,
        })  

        $('<?=  "#merk-detilmesin" ?>').on('select2:select', function (e) {
            var data = e.params.data;
            if (data.id == "-") {
                $("#modal-merkbarang").modal("show")
                $('<?=  "#merk-detilmesin" ?>').val("").trigger("change")
            }
        });
        

        // handler modal section here
        // this function will available if implement modal section
                
    })
</script>