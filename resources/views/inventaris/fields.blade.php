
<div class="form-group col-sm-6 row">
    {!! Form::label('noreg', __("field.noreg")) !!}
    {!! Form::text('noreg', null, \App\Models\BaseModel::generateValidation('noreg', \App\Models\inventaris::$rules, ['class' => 'form-control'])) !!}
</div>


<div class="form-group col-sm-6 row">
    {!! Form::label('pidbarang', __("field.pidbarang")) !!}
    {!! Form::select('pidbarang', [], null, \App\Models\BaseModel::generateValidation('pidbarang', \App\Models\inventaris::$rules, ['class' => 'form-control form-control-lg'])) !!}
</div>

<!-- Pidopd Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pidopd', __("field.pidopd")) !!}
    {!! Form::select('pidopd', [], null, ['class' => 'form-control form-control-lg']) !!}
</div>

<!-- Pidlokasi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pidlokasi',__("field.pidlokasi")) !!}
    {!! Form::select('pidlokasi',[], null, ['class' => 'form-control form-control-lg']) !!}
</div>

<!-- Tgl Sensus Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('tgl_perolehan', 'Tgl Perolehan:') !!}  
    <div class="input-group ">
        {!! Form::text('tgl_perolehan', null, ['class' => 'form-control','id'=>'tgl_perolehan']) !!}
        <div class="input-group-append">
            <span class="input-group-text">
                <span class="fa fa-calendar"></span>
            </span>
        </div>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">     
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
            } 
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
            } 
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
            } 
        })


        $('#satuan').select2({
            ajax: {
                url: "<?= url('api/satuan_barangs') ?>",
                dataType: 'json',
                processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data
                };
                }
            } 
        })

        $('#tgl_perolehan').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('#tgl_sensus').datepicker({
            format: "yyyy-mm-dd",
            autoClose: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    </script>

    @if (isset($inventaris))
    <script>
        App.Helpers.defaultSelect2($('#pidbarang'), "<?= url('api/barangs', [$inventaris->pidbarang]) ?>","id","nama_rek_aset")
        App.Helpers.defaultSelect2($('#pidopd'), "<?= url('api/organisasis', [$inventaris->pidbarang]) ?>","id","nama")
        App.Helpers.defaultSelect2($('#pidlokasi'), "<?= url('api/lokasis', [$inventaris->pidbarang]) ?>","id","nama")
        App.Helpers.defaultSelect2($('#satuan'), "<?= url('api/satuan_barangs', [$inventaris->pidbarang]) ?>","id","nama")
    </script>
    @endif
@endsection

<!-- Tgl Sensus Field -->
<div class="form-group col-sm-6 row">
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
<div class="form-group col-sm-6 row">
    {!! Form::label('volume', 'Volume:') !!}
    {!! Form::number('volume', null, ['class' => 'form-control']) !!}
</div>

<!-- Pembagi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pembagi', 'Pembagi:') !!}
    {!! Form::number('pembagi', null, ['class' => 'form-control']) !!}
</div>

<!-- Satuan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('satuan', 'Satuan:') !!}
    {!! Form::select('satuan', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Harga Satuan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('harga_satuan', 'Harga Satuan:') !!}
    {!! Form::number('harga_satuan', null, ['class' => 'form-control']) !!}
</div>

<!-- Perolehan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('perolehan', 'Perolehan:') !!}
    {!! Form::text('perolehan', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('kondisi', 'Kondisi:') !!}
    {!! Form::select('kondisi',\App\Models\BaseModel::$kondisiDs, null, ['class' => 'form-control']) !!}
</div>

<!-- Lokasi Detil Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('lokasi_detil', 'Lokasi Detil:') !!}
    {!! Form::text('lokasi_detil', null, ['class' => 'form-control']) !!}
</div>

<!-- Umur Ekonomis Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('umur_ekonomis', 'Umur Ekonomis:') !!}
    {!! Form::number('umur_ekonomis', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inventaris.index') !!}" class="btn btn-default">Cancel</a>
</div>
