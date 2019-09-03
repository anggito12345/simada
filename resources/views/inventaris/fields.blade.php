<!-- Noreg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('noreg', 'Noreg:') !!}
    {!! Form::text('noreg', null, ['class' => 'form-control']) !!}
</div>

<!-- Pidbarang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pidbarang', 'Pidbarang:') !!}
    {!! Form::number('pidbarang', null, ['class' => 'form-control']) !!}
</div>

<!-- Pidopd Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pidopd', 'Pidopd:') !!}
    {!! Form::text('pidopd', null, ['class' => 'form-control']) !!}
</div>

<!-- Pidlokasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pidlokasi', 'Pidlokasi:') !!}
    {!! Form::number('pidlokasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Perolehan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_perolehan', 'Tgl Perolehan:') !!}
    {!! Form::date('tgl_perolehan', null, ['class' => 'form-control','id'=>'tgl_perolehan']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tgl_perolehan').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Tgl Sensus Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_sensus', 'Tgl Sensus:') !!}
    {!! Form::date('tgl_sensus', null, ['class' => 'form-control','id'=>'tgl_sensus']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tgl_sensus').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Volume Field -->
<div class="form-group col-sm-6">
    {!! Form::label('volume', 'Volume:') !!}
    {!! Form::number('volume', null, ['class' => 'form-control']) !!}
</div>

<!-- Pembagi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pembagi', 'Pembagi:') !!}
    {!! Form::number('pembagi', null, ['class' => 'form-control']) !!}
</div>

<!-- Satuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('satuan', 'Satuan:') !!}
    {!! Form::text('satuan', null, ['class' => 'form-control']) !!}
</div>

<!-- Harga Satuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('harga_satuan', 'Harga Satuan:') !!}
    {!! Form::number('harga_satuan', null, ['class' => 'form-control']) !!}
</div>

<!-- Perolehan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('perolehan', 'Perolehan:') !!}
    {!! Form::text('perolehan', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kondisi', 'Kondisi:') !!}
    {!! Form::text('kondisi', null, ['class' => 'form-control']) !!}
</div>

<!-- Lokasi Detil Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lokasi_detil', 'Lokasi Detil:') !!}
    {!! Form::text('lokasi_detil', null, ['class' => 'form-control']) !!}
</div>

<!-- Umur Ekonomis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('umur_ekonomis', 'Umur Ekonomis:') !!}
    {!! Form::number('umur_ekonomis', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inventaris.index') !!}" class="btn btn-default">Cancel</a>
</div>
