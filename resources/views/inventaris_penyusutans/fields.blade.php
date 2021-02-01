<!-- Deskripsi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deskripsi', 'Deskripsi:') !!}
    {!! Form::text('deskripsi', null, ['class' => 'form-control']) !!}
</div>

<!-- Beban Penyusutan Perbulan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('beban_penyusutan_perbulan', 'Beban Penyusutan Perbulan:') !!}
    {!! Form::number('beban_penyusutan_perbulan', null, ['class' => 'form-control']) !!}
</div>

<!-- Masa Manfaat Sd Akhir Tahun Field -->
<div class="form-group col-sm-6">
    {!! Form::label('masa_manfaat_sd_akhir_tahun', 'Masa Manfaat Sd Akhir Tahun:') !!}
    {!! Form::number('masa_manfaat_sd_akhir_tahun', null, ['class' => 'form-control']) !!}
</div>

<!-- Penyusutan Sd Tahun Sebelumnya Field -->
<div class="form-group col-sm-6">
    {!! Form::label('penyusutan_sd_tahun_sebelumnya', 'Penyusutan Sd Tahun Sebelumnya:') !!}
    {!! Form::number('penyusutan_sd_tahun_sebelumnya', null, ['class' => 'form-control']) !!}
</div>

<!-- Running Penyesutan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('running_penyesutan', 'Running Penyesutan:') !!}
    {!! Form::date('running_penyesutan', null, ['class' => 'form-control','id'=>'running_penyesutan']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#running_penyesutan').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Running Sd Bulan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('running_sd_bulan', 'Running Sd Bulan:') !!}
    {!! Form::number('running_sd_bulan', null, ['class' => 'form-control']) !!}
</div>

<!-- Penyusutan Tahun Sekarang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('penyusutan_tahun_sekarang', 'Penyusutan Tahun Sekarang:') !!}
    {!! Form::number('penyusutan_tahun_sekarang', null, ['class' => 'form-control']) !!}
</div>

<!-- Penyusutan Sd Tahun Sekarang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('penyusutan_sd_tahun_sekarang', 'Penyusutan Sd Tahun Sekarang:') !!}
    {!! Form::number('penyusutan_sd_tahun_sekarang', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('inventarisPenyusutans.index') }}" class="btn btn-default">Cancel</a>
</div>
