<!-- Pid Field -->


<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">    
    {!! Form::label('pid', __('field.pid')) !!}
    {!! Form::select('pid', [], null, ['class' => 'form-control', 'id' => 'pid-'. $idPostfix]) !!}
</div>

<!-- Kodetampil Field -->
<!--<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kodetampil', 'Kode:') !!}
    {!! Form::text('kodetampil', null, ['class' => 'form-control']) !!}
</div>-->

<!-- Kode Rek Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode_rek', 'Kode:') !!}
    {!! Form::text('kode_rek', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Rek Aset Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('nama_rek_aset', __('field.nama_rek_aset')) !!}
    {!! Form::text('nama_rek_aset', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Barang Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('jenis_barang', 'Jenis Barang:') !!}
    {!! Form::number('jenis_barang', null, ['class' => 'form-control']) !!}
</div>

<!-- Umur Ekononomis Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('umur_ekononomis', 'Umur Ekononomis:') !!}
    {!! Form::number('umur_ekononomis', null, ['class' => 'form-control']) !!}
</div>

<!-- Aset Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('aset', 'Aset:') !!}
    {!! Form::text('aset', null, ['class' => 'form-control']) !!}
</div>

<!-- Obyek Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('obyek', 'Obyek:') !!}
    {!! Form::text('obyek', null, ['class' => 'form-control']) !!}
</div>

<!-- Rincianobyek Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('rincianobyek', 'Rincian Obyek:') !!}
    {!! Form::text('rincianobyek', null, ['class' => 'form-control']) !!}
</div>

<!-- Subrincianobyek Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('subrincianobyek', 'Subrincian Obyek:') !!}
    {!! Form::text('subrincianobyek', null, ['class' => 'form-control']) !!}
</div>

@if(strpos($idPostfix, 'non-ajax') > -1)
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('barangs.index') !!}" class="btn btn-default">Cancel</a>
</div>
@endif

@section(strpos($idPostfix, 'non-ajax') > -1 ? 'scripts' : 'scripts_2')
    <script type="text/javascript">        
        $('<?=  "#pid-".$idPostfix ?>').select2({
            ajax: {
                url: "<?= url('api/barangs') ?>",
                dataType: 'json',
                processResults: function (data) {

                    let options = {
                        id: "-",
                        text: "<div class='text-gray'>Tambah Barang Baru</div>"
                    }
                    let id = '<?=  "#pid-".$idPostfix ?>'
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

        $('<?=  "#pid-".$idPostfix ?>').on('select2:select', function (e) {
            var data = e.params.data;
            if (data.id == "-") {
                $("#modal-barang").modal("show")
                $('<?=  "#pid-".$idPostfix ?>').val("").trigger("change")
            }
        });
        

        // handler modal section here
        // this function will available if implement modal section
        function saveJson() {

            $.ajax({
                url: "<?= url('api/barangs') ?>",
                dataType: "json",
                method: "POST",
                data: App.Helpers.getFormData($("#form-modal-barang")),
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
                   
                    $("#modal-barang").modal("hide")
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
    @if (isset($barang))
    <script>
        App.Helpers.defaultSelect2($('<?=  "#pid-".$idPostfix ?>'), "<?= url('api/barangs', [$barang->pid]) ?>","id","nama_rek_aset")
    </script>
    @endif
@endsection