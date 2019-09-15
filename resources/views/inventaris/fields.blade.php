
<!-- <div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidbarang', __("field.pidbarang")) !!}
    {!! Form::select('pidbarang', [], null, \App\Models\BaseModel::generateValidation('pidbarang', \App\Models\inventaris::$rules, ['class' => 'form-control form-control-lg'])) !!}
</div> -->

<div class="form-group col-sm-6 no-padding <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?>">
    {!! Form::label('pidbarang', 'Barang') !!} 
    <div class="row">
        <div class="col-md-4">
            {!! Form::text('kodebarang', null, ['class' => 'form-control','style' => 'margin:1px -15px 0 0px; float:left', 'readonly' => true]) !!} 
        </div>
        <div class="col-md-8">
            {!! Form::text('pidbarang', null, ['class' => 'form-control baranglookup', 'id' => 'baranglookup']) !!}
        </div>
    </div>    
</div>

<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    <!-- Tahun Perolehan -->
    {!! Form::label('tahun_perolehan', 'Tahun Perolehan') !!}
    <div class="input-group">
        
        {!! Form::text('tahun_perolehan', null, ['class' => 'form-control', 'maxlength' => 4]) !!}
        <div class="input-group-append">
            <span class="input-group-text text-danger" id="basic-addon2">4 digit (mis: 1998)</span>Fz
        </div>
    </div>
</div>

<!-- Harga Satuan Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('harga_satuan', 'Harga Satuan:') !!}
    <div class="input-group">
        <div class="input-group-prepend">1`
            <span class="input-group-text" id="basic-addon1">Rp.</span>
        </div>
        {!! Form::text('harga_satuan', null, ['class' => 'form-control']) !!}        
    </div>   
</div>


<!-- <div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('noreg', __("field.noreg")) !!}
    {!! Form::text('noreg', null, \App\Models\BaseModel::generateValidation('noreg', \App\Models\inventaris::$rules, ['class' => 'form-control'])) !!}
</div> -->

<!-- Pidopd Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidopd', __("field.pidopd")) !!}
    {!! Form::select('pidopd', [], null, ['class' => 'form-control form-control-lg']) !!}
</div>

<!-- Pidlokasi Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pidlokasi',__("field.pidlokasi")) !!}
    {!! Form::select('pidlokasi',[], null, ['class' => 'form-control form-control-lg']) !!}
</div>


<!-- Tgl Sensus Field -->
<!-- <div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('tgl_perolehan', 'Tgl Perolehan:') !!}  
    <div class="input-group ">
        {!! Form::text('tgl_perolehan', null, ['class' => 'form-control','id'=>'tgl_perolehan']) !!}
        <div class="input-group-append">
            <span class="input-group-text">
                <span class="fa fa-calendar"></span>
            </span>
        </div>
    </div>
</div> -->

@section(!isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'scripts' : 'scripts_2')
    <script type="text/javascript">   
        const funcBarangSelect = function(d) {            
            let appendKode = ""
            if (d.kode_akun != "" && d.kode_akun != null) {
                appendKode += d.kode_akun
            }

            if (d.kode_kelompok != "" && d.kode_kelompok != null) {
                appendKode += "." + d.kode_kelompok
            }

            if (d.kode_jenis != "" && d.kode_jenis != null) {
                appendKode += "." + d.kode_jenis
            }

            if (d.kode_objek != "" && d.kode_objek != null) {
                appendKode += "." + d.kode_objek
            }

            if (d.kode_rincian_objek != "" && d.kode_rincian_objek != null) {
                appendKode += "." + d.kode_rincian_objek
            }

            if (d.kode_sub_rincian_objek != "" && d.kode_sub_rincian_objek != null) {
                appendKode += "." + d.kode_sub_rincian_objek
            }

            if (d.kode_sub_sub_rincian_objek != "" && d.kode_sub_sub_rincian_objek != null) {
                appendKode += "." + d.kode_sub_sub_rincian_objek
            }

            $("[name=kodebarang]").val(appendKode)
        }
                  
    
        $(".baranglookup").LookupTable({
            DataTable: {
                ajax: {
                    url: $("[base-path]").val() + "/api/barangs/get",
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'nama_rek_aset', title: 'Nama Barang' },
                    
                ],
                "processing": true,
                "serverSide": true,
                "searching": false,      
                responsive: true,    
                custom: {
                    typeInput: 'radio',
                    textField: 'nama_rek_aset',
                    valueField: 'id',
                    autoClose: false,
                    filters: [
                        { name: "kode_jenis", type: "select2", title: "Bidang" , select2config: {                            
                            ajax: {                                
                                url: "<?= url('api/jenisbarangs') ?>",
                                dataType: 'json',
                                data: function (params) {

                                    return params;
                                },
                                processResults: function (data) {
                                    // Transforms the top-level key of the response object from 'items' to 'results'
                                    return {
                                        results: data.data.map((d) => {
                                            d.text = d.nama
                                            d.id = parseInt(d.kode)

                                            return d
                                        })
                                    };
                                }
                            },
                            theme: 'bootstrap' ,
                            custom: {
                                valueField: "kode",
                                change: (obj) => {                                    
                                    let idInput = obj.currentTarget.id
                                    $("#" + idInput.replace('kode_jenis', 'kode_objek')).val("").trigger('change')
                                }
                            }
                        }},
                        { name: "kode_objek", type: "select2", title: "Kelompok" , select2config: {                            
                            ajax: {                                
                                url: "<?= url('api/barangs') ?>",
                                dataType: 'json',
                                data: function (params) {
                                    idInput = $(this)[0].id

                                    params.kode_jenis = $("#" + idInput.replace('kode_objek', 'kode_jenis')).val() 

                                    return params;
                                },
                                processResults: function (data) {
                                    // Transforms the top-level key of the response object from 'items' to 'results'
                                    return {
                                        results: data.data.map((d) => {
                                            d.text = d.nama_rek_aset
                                            d.id = d.id
                                            return d
                                        })
                                    };
                                },                                
                            },
                            theme: 'bootstrap' ,
                            custom: {
                                valueField: "kode_objek",
                                change: (obj) => {                                    
                                    let idInput = obj.currentTarget.id
                                    $("#" + idInput.replace('kode_objek', 'kode_rincian_objek')).val("").trigger('change')
                                }
                            }
                        }},
                        { name: "kode_rincian_objek", type: "select2", title: "Sub Kelompok" , select2config: {                            
                            ajax: {                                
                                url: "<?= url('api/barangs') ?>",
                                dataType: 'json',
                                data: function (params) {
                                    idInput = $(this)[0].id
                                    

                                    params.kode_objek = $("#" + idInput.replace('kode_rincian_objek', 'kode_objek')).select2('data')[0].kode_objek 
                                    params.kode_jenis = $("#" + idInput.replace('kode_rincian_objek', 'kode_jenis')).val() 

                                    return params;
                                },
                                processResults: function (data) {
                                    // Transforms the top-level key of the response object from 'items' to 'results'
                                    return {
                                        results: data.data.map((d) => {
                                            d.text = d.nama_rek_aset
                                            d.id = d.id
                                            return d
                                        })
                                    };
                                },
                                
                            },
                            theme: 'bootstrap' ,
                            custom: {
                                valueField: "kode_rincian_objek",
                                change: (obj) => {                                    
                                    let idInput = obj.currentTarget.id
                                    $("#" + idInput.replace('kode_rincian_objek', 'kode_sub_rincian_objek')).val("").trigger('change')
                                }
                            }
                        }},
                        { name: "kode_sub_rincian_objek", type: "select2", title: "Sub Sub Kelompok" , select2config: {                            
                            ajax: {                                
                                url: "<?= url('api/barangs') ?>",
                                dataType: 'json',
                                data: function (params) {
                                    idInput = $(this)[0].id
                                    params.kode_objek = $("#" + idInput.replace('kode_sub_rincian_objek', 'kode_objek')).select2('data')[0].kode_objek 
                                    params.kode_jenis = $("#" + idInput.replace('kode_sub_rincian_objek', 'kode_jenis')).val() 
                                    params.kode_rincian_objek = $("#" + idInput.replace('kode_sub_rincian_objek', 'kode_rincian_objek')).select2('data')[0].kode_rincian_objek 

                                    return params;
                                },
                                processResults: function (data) {
                                    // Transforms the top-level key of the response object from 'items' to 'results'
                                    return {
                                        results: data.data.map((d) => {
                                            d.text = d.nama_rek_aset
                                            return d
                                        })
                                    };
                                }
                            },
                            theme: 'bootstrap' ,
                            custom: {
                                valueField: "kode_sub_rincian_objek"
                            }
                        }},
                        { name: "nama_rek_aset", type:"text", title: "Ketik nama barang/jenis barang yang akan dicari"},
                    ],                 
                    select: funcBarangSelect
                }
            }
        })

        $('#harga_satuan').mask("#.##0", {reverse: true});

        $('#pidbarang').select2({
            ajax: {
                url: "<?= url('api/barangs') ?>",
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

        $('#pidopd').select2({
            ajax: {
                url: "<?= url('api/organisasis') ?>",
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

        $('#pidlokasi').select2({
            ajax: {
                url: "<?= url('api/lokasis') ?>",
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


        $('#satuan').select2({
            ajax: {
                url: "<?= url('api/satuanbarangs') ?>",
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

        // $('#tgl_perolehan').datepicker({
        //     format: "yyyy-mm-dd",
        //     autoClose: true
        // }).on('changeDate', function (ev) {
        //     $(this).datepicker('hide');
        // });

        $('#tgl_sensus').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    </script>

    @if (isset($inventaris))
    <script>
        $(".baranglookup").LookupTable().setValAjax("<?= url('api/barangs', [$inventaris->pidbarang]) ?>").then((d) => {
            funcBarangSelect(d)
        })
    </script>
    @endif
@endsection

<!-- Tgl Sensus Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('tgl_sensus', 'Tgl Sensus:') !!}
    <div class="input-group ">
        {!! Form::text('tgl_sensus', null, ['class' => 'form-control','id'=>'tgl_sensus']) !!}
        <div class="input-group-append">
            <span class="input-group-text">
                <span class="fa fa-calendar"></span>
            </span>
        </div>
    </div>
</div>

<!-- Volume Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('volume', 'Volume:') !!}
    {!! Form::number('volume', null, ['class' => 'form-control']) !!}
</div>

<!-- Pembagi Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('pembagi', 'Pembagi:') !!}
    {!! Form::number('pembagi', null, ['class' => 'form-control']) !!}
</div>

<!-- Satuan Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('satuan', 'Satuan:') !!}
    {!! Form::select('satuan', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Perolehan Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('perolehan', 'Perolehan:') !!}
    {!! Form::text('perolehan', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('kondisi', 'Kondisi:') !!}
    {!! Form::select('kondisi',\App\Models\BaseModel::$kondisiDs, null, ['class' => 'form-control']) !!}
</div>

<!-- Lokasi Detil Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('lokasi_detil', 'Lokasi Detil:') !!}
    {!! Form::text('lokasi_detil', null, ['class' => 'form-control']) !!}
</div>

<!-- Umur Ekonomis Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('umur_ekonomis', 'Umur Ekonomis:') !!}
    {!! Form::number('umur_ekonomis', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6 <?= !isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1 ? 'col-md-6' : 'col-md-12' ?> row">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

@if(!isset($idPostfix) || strpos($idPostfix, 'non-ajax') > -1)
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('barangs.index') !!}" class="btn btn-default">Cancel</a>
</div>
@endif
