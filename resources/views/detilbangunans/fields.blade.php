<!-- Pidinventaris Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pidinventaris', __('field.pidinventaris')) !!}
    {!! Form::select('pidinventaris', [], null, ['class' => 'form-control','id' => 'pidinventaris-'. $idPostfix]) !!}
</div>

<!-- Konstruksi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('konstruksi', 'Konstruksi:') !!}
    {!! Form::select('konstruksi', \App\Models\BaseModel::$konstruksiDs, null, ['class' => 'form-control']) !!}
</div>

<!-- Bertingkat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('bertingkat', 'Bertingkat:') !!}&nbsp;
    <div class="radio">
        {!! Form::radio('bertingkat', 1, isset($detilbangunan) ? $detilbangunan->bertingkat == 1 : false) !!} Ya
        {!! Form::radio('bertingkat', 0, isset($detilbangunan) ? $detilbangunan->bertingkat == 0 : false) !!} Tidak
    </div>
</div>

<!-- Beton Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('beton', 'Beton:') !!}&nbsp;
    <div class="radio">
        {!! Form::radio('beton', 1, isset($detilbangunan) ? $detilbangunan->beton == 1 : false) !!} Ya
        {!! Form::radio('beton', 0, isset($detilbangunan) ? $detilbangunan->beton == 0 : false) !!} Tidak
    </div>
</div>

<!-- Luasbangunan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('luasbangunan', 'Luas Bangunan:') !!}
    {!! Form::number('luasbangunan', null, ['class' => 'form-control']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Idkota Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('idkota', __('field.idkota')) !!}
    {!! Form::select('idkota', [], null, ['class' => 'form-control']) !!}
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
    {!! Form::label('koordinatlokasi', 'Koordinat Lokasi:') !!}
    {!! Form::text('koordinatlokasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Koordinattanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('koordinattanah', 'Koordinat Tanah:') !!}
    {!! Form::text('koordinattanah', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgldokumen Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('tgldokumen', 'Tgl Dokumen:') !!}
    {!! Form::text('tgldokumen', null, ['class' => 'form-control','id'=>'tgldokumen']) !!}
</div>

@section('scripts')
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

        $('#statustanah').select2({
            ajax: {
                url: "<?= url('api/statustanahs') ?>",
                dataType: 'json',
                processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data
                };
                }
            },
            theme: 'bootstrap' , 
        })

        $('#kodetanah').select2({
            ajax: {
                url: "<?= url('api/detiltanahs') ?>",
                dataType: 'json',
                processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data
                };
                }
            },
            theme: 'bootstrap' , 
        })

        $('#tgldokumen').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    </script>
    @if (isset($detilbangunan))
    <script>
        App.Helpers.defaultSelect2($('#statustanah'), "<?= url('api/statustanahs', [$detilbangunan->statustanah]) ?>","id","nama")
        App.Helpers.defaultSelect2($('#kodetanah'), "<?= url('api/detiltanahs', [$detilbangunan->kodetanah]) ?>","id",["nama_kota",", ", "nama_kecamatan", ", ", "nama_sertifikat"])
        App.Helpers.defaultSelect2($('<?=  "#pidinventaris-".$idPostfix ?>'), "<?= url('api/inventaris', [$detilbangunan->pidinventaris]) ?>","id","noreg")
        App.Helpers.defaultSelect2(
                $("#idkota"), "<?= url('api/alamats', [$detilbangunan->idkota]) ?>",
                "id",
                "nama",
                () => {
                    App.Helpers.defaultSelect2(
                        $("#idkecamatan"), 
                        "<?= url('api/alamats', [$detilbangunan->idkecamatan]) ?>",
                        "id",
                        "nama",
                        () => {
                            App.Helpers.defaultSelect2($("#idkelurahan"), "<?= url('api/alamats', [$detilbangunan->idkelurahan]) ?>","id","nama")
                        }
                    )
                }
            )
        
        
    </script>
    @endif
@endsection

<!-- Nodokumen Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nodokumen', 'No Dokumen:') !!}
    {!! Form::text('nodokumen', null, ['class' => 'form-control']) !!}
</div>

<!-- Luastanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('luastanah', 'Luas Tanah:') !!}
    {!! Form::number('luastanah', null, ['class' => 'form-control']) !!}
</div>

<!-- Statustanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('statustanah', 'Status Tanah:') !!}
    {!! Form::select('statustanah', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Kodetanah Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('kodetanah', 'Kode Tanah:') !!}
    {!! Form::select('kodetanah', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Dokumen Field -->
<!-- <div class="form-group col-sm-6 row">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::text('dokumen', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Keterangan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<!-- <div class="form-group col-sm-6 row">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::text('foto', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('detilbangunans.index') !!}" class="btn btn-default">Cancel</a>
</div>
