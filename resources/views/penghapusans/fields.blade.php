<!-- Pidinventaris Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pidinventaris', 'Pidinventaris:') !!}
    {!! Form::number('pidinventaris', null, ['class' => 'form-control']) !!}
</div>

<!-- Noreg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('noreg', 'Noreg:') !!}
    {!! Form::text('noreg', null, ['class' => 'form-control']) !!}
</div>

<!-- Tglhapus Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tglhapus', 'Tglhapus:') !!}
    {!! Form::date('tglhapus', null, ['class' => 'form-control','id'=>'tglhapus']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tglhapus').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Kriteria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kriteria', 'Kriteria:') !!}
    {!! Form::text('kriteria', null, ['class' => 'form-control']) !!}
</div>

<!-- Kondisi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kondisi', 'Kondisi:') !!}
    {!! Form::text('kondisi', null, ['class' => 'form-control']) !!}
</div>

<!-- Harga Apprisal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('harga_apprisal', 'Harga Apprisal:') !!}
    {!! Form::text('harga_apprisal', null, ['class' => 'form-control']) !!}
</div>

<!-- Dokumen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dokumen', 'Dokumen:') !!}
    {!! Form::text('dokumen', null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::text('foto', null, ['class' => 'form-control']) !!}
</div>

<!-- Nosk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nosk', 'Nosk:') !!}
    {!! Form::text('nosk', null, ['class' => 'form-control']) !!}
</div>

<!-- Tglsk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tglsk', 'Tglsk:') !!}
    {!! Form::date('tglsk', null, ['class' => 'form-control','id'=>'tglsk']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tglsk').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('penghapusans.index') !!}" class="btn btn-default">Cancel</a>
</div>
