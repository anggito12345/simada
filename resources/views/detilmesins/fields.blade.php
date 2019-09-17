
<!-- Pidinventaris Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pidinventaris', __('field.pidinventaris')) !!}
    {!! Form::select('pidinventaris',[], null, ['class' => 'form-control','id' => 'pidinventaris-'. $idPostfix]) !!}
</div>

<!-- Merk Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('merk', 'Merk:') !!}
    {!! Form::select('merk',[], null, ['class' => 'form-control','id' => 'merk-'. $idPostfix]) !!}
</div>

<!-- Ukuran Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('ukuran', 'Ukuran:') !!}
    {!! Form::text('ukuran', null, ['class' => 'form-control']) !!}
</div>

<!-- Bahan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('bahan', 'Bahan:') !!}
    {!! Form::text('bahan', null, ['class' => 'form-control']) !!}
</div>

<!-- Norangka Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('norangka', 'No Rangka:') !!}
    {!! Form::text('norangka', null, ['class' => 'form-control']) !!}
</div>

<!-- Nomesin Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nomesin', 'No Mesin:') !!}
    {!! Form::text('nomesin', null, ['class' => 'form-control']) !!}
</div>

<!-- Nopol Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nopol', 'Nopol:') !!}
    {!! Form::text('nopol', null, ['class' => 'form-control']) !!}
</div>

<!-- Bpkb Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('bpkb', 'Nomor BPKB:') !!}
    {!! Form::text('bpkb', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Dokumen Field -->
<!-- <div class="form-group col-sm-6 row">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::text('dokumen', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Foto Field -->
<!-- <div class="form-group col-sm-6 row">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::text('foto', null, ['class' => 'form-control']) !!}
</div> -->

@if(!isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1)
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('detilmesins.index') !!}" class="btn btn-default">Cancel</a>
</div>
@endif

@section('scripts') 
<script>

    $('<?= "#merk-".$idPostfix ?>').select2({
        ajax: {
            url: "<?= url('api/merkbarangs') ?>",
            dataType: 'json',
            processResults: function (data) {

                let options = {
                    id: "-",
                    text: "<div class='text-gray'>Tambah Merk Barang Baru</div>"
                }
                let id = '<?=  "#merk-".$idPostfix ?>'
                if (id.indexOf("non-ajax") > -1) {
                    data.data.unshift(options)
                }
                
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

    $('<?=  "#merk-".$idPostfix ?>').on('select2:select', function (e) {
        var data = e.params.data;
        if (data.id == "-") {
            $("#modal-merkbarang").modal("show")
            $('<?=  "#merk-".$idPostfix ?>').val("").trigger("change")
        }
    });
    

    // handler modal section here
    // this function will available if implement modal section
    function saveJsonMerkBarang() {
        $.ajax({
            url: "<?= url('api/merkbarangs') ?>",
            dataType: "json",
            method: "POST",
            data: App.Helpers.getFormData($("#form-modal-merkbarang")),
            success: (response) => {
                if (response.success) {
                    Swal.fire({
                        type: 'success',
                        text: 'Data berhasil disimpan',
                    })
                } else {
                    Swal.fire({
                        type: 'error',
                        text: 'Data gagal disimpan',
                    })
                }
                
                $("#modal-merkbarang").modal("hide")
            },
            error: (response) => {                    
                Swal.fire({
                    type: 'error',
                    text: 'Data gagal disimpan',
                })
            }
        })
    }


    $('<?=  "#pidinventaris-".$idPostfix ?>').select2({
        ajax: {
            url: "<?= url('api/inventaris') ?>",
            dataType: 'json',
            processResults: function (data) {

                let options = {
                    id: "-",
                    text: "<div class='text-gray'>Tambah Inventaris Baru</div>"
                }
                let id = '<?=  "#pidinventaris-".$idPostfix ?>'
                if (id.indexOf("non-ajax") > -1) {
                    data.data.unshift(options)
                }                    
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

    $('<?=  "#pidinventaris-".$idPostfix ?>').on('select2:select', function (e) {
        var data = e.params.data;
        if (data.id == "-") {
            $("#modal-inventaris").modal("show")
            $('<?=  "#pidinventaris-".$idPostfix ?>').val("").trigger("change")
        }
    });
    

    // handler modal section here
    // this function will available if implement modal section
    function saveJson() {

        $.ajax({
            url: "<?= url('api/inventaris') ?>",
            dataType: "json",
            method: "POST",
            data: App.Helpers.getFormData($("#form-modal-inventaris")),
            success: (response) => {
                if (response.success) {
                    Swal.fire({
                        type: 'success',
                        text: 'Data berhasil disimpan',
                    })
                } else {
                    Swal.fire({
                        type: 'error',
                        text: 'Data gagal disimpan',
                    })
                }
                
                $("#modal-inventaris").modal("hide")
            },
            error: (response) => {                    
                Swal.fire({
                    type: 'error',
                    text: 'Data gagal disimpan',
                })
            }
        })
    }
</script>

@if (isset($detilmesin))
<script>
    App.Helpers.defaultSelect2($('<?=  "#pidinventaris-".$idPostfix ?>'), "<?= url('api/inventaris', [$detilmesin->pidinventaris]) ?>","id","noreg")
    App.Helpers.defaultSelect2($('<?=  "#merk-".$idPostfix ?>'), "<?= url('api/merkbarangs', [$detilmesin->merk]) ?>","id","nama")
    
</script>
@endif
@endsection