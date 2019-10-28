<!-- Opd Asal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opd_asal', 'Opd Asal:') !!}
    {!! Form::number('opd_asal', null, ['class' => 'form-control']) !!}
</div>

<!-- Opd Tujuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opd_tujuan', 'Opd Tujuan:') !!}
    {!! Form::number('opd_tujuan', null, ['class' => 'form-control']) !!}
</div>

<!-- No Bast Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_bast', 'No Bast:') !!}
    {!! Form::text('no_bast', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Bast Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_bast', 'Tgl Bast:') !!}
    {!! Form::date('tgl_bast', null, ['class' => 'form-control','id'=>'tgl_bast']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tgl_bast').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Idpegawai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idpegawai', 'Idpegawai:') !!}
    {!! Form::number('idpegawai', null, ['class' => 'form-control']) !!}
</div>

<!-- Alasan Mutasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alasan_mutasi', 'Alasan Mutasi:') !!}
    {!! Form::text('alasan_mutasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mutasis.index') !!}" class="btn btn-default">Cancel</a>
</div>
