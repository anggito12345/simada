<!-- Pid Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pid', __('field.pid')) !!}
    {!! Form::select('pid', [], null, ['class' => 'form-control', 'id' => 'pid-'. $idPostfix]) !!}
</div>

<!-- Kode Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kode', 'Kode:') !!}
    {!! Form::text('kode', null, ['class' => 'form-control']) !!}
</div>


<!-- Nama Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Latitude Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('latitude', 'Latitude:') !!}
    {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
</div>

<!-- Longitude Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('longitude', 'Longitude:') !!}
    {!! Form::text('longitude', null, ['class' => 'form-control']) !!}
</div>


<!-- Jenis Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('jenis', 'Jenis:') !!}
    {!! Form::select('jenis', \App\Models\BaseModel::$jenisKotaDs, null, ['class' => 'form-control']) !!}
</div>

<!-- Kodepos Field -->
<div class="form-group <?= strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kodepos', 'Kodepos:') !!}
    {!! Form::text('kodepos', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
@if(strpos($idPostfix, 'non-ajax') > -1)
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('alamats.index') !!}" class="btn btn-default">Batal</a>
</div>
@endif


@section(strpos($idPostfix, 'non-ajax') > -1 ? 'scripts' : 'scripts_2')
    <script type="text/javascript">
        var sourceConstantJenis = <?= json_encode(\App\Models\BaseModel::$jenisKotaDs) ?>;
        $('<?=  "#pid-".$idPostfix ?>').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        take: 15,
                        q: params.term,
                        fieldText: "concat(jenis, ' - ', nama)",
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {

                    let options = {
                        id: "-",
                        text: "<div class='text-gray'>Tambah Alamat Baru</div>"
                    }
                    let id = '<?=  "#pid-".$idPostfix ?>'
                    if (id.indexOf("non-ajax") > -1) {
                        data.data.unshift(options)
                    }

                    data.data.map(function(d) {
                        let splittedText = d.text.split('-');
                        if (d.text.indexOf("-") > -1 && sourceConstantJenis[parseInt(splittedText[0])] != undefined) {

                            console.log(splittedText);
                            d.text = sourceConstantJenis[parseInt(splittedText[0])] + ' - ' + splittedText[1]
                        }

                        return d
                    })

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
                $("#modal-alamat").modal("show")
                $('<?=  "#pid-".$idPostfix ?>').val("").trigger("change")
            }
        });


        // handler modal section here
        // this function will available if implement modal section
        function saveJson() {

            $.ajax({
                url: "<?= url('api/alamats') ?>",
                dataType: "json",
                method: "POST",
                data: App.Helpers.getFormData($("#form-modal-alamat")),
                success: (response) => {
                    if (response.success) {
                        Swal.fire({
                            type: 'success',
                            text: 'Data berhasil disimpan',
                        })
                        $("#form-modal-alamat").trigger("reset");
                    } else {
                        Swal.fire({
                            type: 'error',
                            text: 'Data gagal disimpan',
                        })
                    }

                    $("#modal-alamat").modal("hide")
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
    @if (isset($alamat) && $alamat->pid != "")
    <script>
        App.Helpers.defaultSelect2($('<?=  "#pid-".$idPostfix ?>'), "<?= url('api/alamats', [$alamat->pid]) ?>","id","nama")
    </script>
    @endif
@endsection
