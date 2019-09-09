<!-- Pidinventaris Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pidinventaris', __('field.pidinventaris')) !!}
    {!! Form::select('pidinventaris',[], null, ['class' => 'form-control','id' => 'pidinventaris-'. $idPostfix]) !!}
</div>

<!-- Luas Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('luas', 'Luas:') !!}
    {!! Form::number('luas', null, ['class' => 'form-control']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Idkota Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('idkota', __('field.idkota')) !!}
    {!! Form::select('idkota',[], null, ['class' => 'form-control']) !!}
</div>

<!-- Idkecamatan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('idkecamatan', __('field.idkecamatan')) !!}
    {!! Form::select('idkecamatan', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Idkelurahan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('idkelurahan', __('field.idkelurahan')) !!}
    {!! Form::select('idkelurahan', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Koordinatlokasi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('koordinatlokasi', 'Koordinat lokasi:') !!}
    {!! Form::text('koordinatlokasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Koordinattanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('koordinattanah', 'Koordinat tanah:') !!}
    {!! Form::text('koordinattanah', null, ['class' => 'form-control']) !!}
</div>

<!-- Hak Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('hak', 'Hak:') !!}
    {!! Form::text('hak', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Sertifikat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('status_sertifikat', 'Status Sertifikat:') !!}
    {!! Form::text('status_sertifikat', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Sertifikat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('tgl_sertifikat', 'Tgl Sertifikat:') !!}
    {!! Form::text('tgl_sertifikat', null, ['class' => 'form-control','id'=>'tgl_sertifikat']) !!}
</div>

<!-- Nama Sertifikat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nama_sertifikat', 'Nama Sertifikat:') !!}
    {!! Form::text('nama_sertifikat', null, ['class' => 'form-control']) !!}
</div>

<!-- Penggunaan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('penggunaan', 'Penggunaan:') !!}
    {!! Form::text('penggunaan', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Dokumen Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('dokumen', 'Dokumen:') !!} <br />
    {!! Form::file('dokumen', ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('foto', 'Foto:') !!} <br />
    {!! Form::file('foto', ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('detiltanahs.index') !!}" class="btn btn-default">Cancel</a>
</div>


@section(strpos($idPostfix, 'non-ajax') > -1 ? 'scripts' : 'scripts_2')
    <script type="text/javascript">       


        $('#idkota').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,                                           
                        addWhere: [
                            "jenis = 'Kota'"
                        ]
                    } 
                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data
                    };
                }
            },
            theme: 'bootstrap' ,
        })


        $('#idkota').on('change', function (e) {
            $("#idkecamatan").val("").trigger("change")
        });


        $('#idkecamatan').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,                                           
                        addWhere: [
                            "jenis = 'Kecamatan'",
                            "pid = " + $("#idkota").val()
                        ]
                    }                    

                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data
                    };
                }
            },
            theme: 'bootstrap' ,
        })

        $('#idkecamatan').on('change', function (e) {
            $("#idkelurahan").val("").trigger("change")
        });

        $('#idkelurahan').select2({
            ajax: {
                url: "<?= url('api/alamats') ?>",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,                                           
                        addWhere: [
                            "jenis = 'Kelurahan/Desa'",
                            "pid = " + $("#idkecamatan").val()
                        ]
                    }                    

                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data
                    };
                }
            },
            theme: 'bootstrap' ,
        })


        $('#tgl_sertifikat').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

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
    @if (isset($detiltanah))
    <script>
        App.Helpers.defaultSelect2($('<?=  "#pidinventaris-".$idPostfix ?>'), "<?= url('api/inventaris', [$detiltanah->pidinventaris]) ?>","id","noreg")
        App.Helpers.defaultSelect2(
                $("#idkota"), "<?= url('api/alamats', [$detiltanah->idkota]) ?>",
                "id",
                "nama",
                () => {
                    App.Helpers.defaultSelect2(
                        $("#idkecamatan"), 
                        "<?= url('api/alamats', [$detiltanah->idkecamatan]) ?>",
                        "id",
                        "nama",
                        () => {
                            App.Helpers.defaultSelect2($("#idkelurahan"), "<?= url('api/alamats', [$detiltanah->idkelurahan]) ?>","id","nama")
                        }
                    )
                }
            )
        
        
    </script>
    @endif
@endsection
