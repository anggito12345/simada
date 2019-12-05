<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

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

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Tahun Perolehan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tahun_perolehan', 'Tahun Perolehan:') !!}
    {!! Form::text('tahun_perolehan', null, ['class' => 'form-control']) !!}
</div>

<!-- Jumlah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jumlah', 'Jumlah:') !!}
    {!! Form::number('jumlah', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Dibukukan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_dibukukan', 'Tgl Dibukukan:') !!}
    {!! Form::date('tgl_dibukukan', null, ['class' => 'form-control','id'=>'tgl_dibukukan']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tgl_dibukukan').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Satuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('satuan', 'Satuan:') !!}
    {!! Form::number('satuan', null, ['class' => 'form-control']) !!}
</div>

<!-- Draft Field -->
<div class="form-group col-sm-6">
    {!! Form::label('draft', 'Draft:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('draft', 0) !!}
        {!! Form::checkbox('draft', '1', null) !!}
    </label>
</div>


<!-- Pidopd Cabang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pidopd_cabang', 'Pidopd Cabang:') !!}
    {!! Form::number('pidopd_cabang', null, ['class' => 'form-control']) !!}
</div>

<!-- Pidupt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pidupt', 'Pidupt:') !!}
    {!! Form::number('pidupt', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Lokasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kode_lokasi', 'Kode Lokasi:') !!}
    {!! Form::text('kode_lokasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Alamat Propinsi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alamat_propinsi', 'Alamat Propinsi:') !!}
    {!! Form::number('alamat_propinsi', null, ['class' => 'form-control']) !!}
</div>

<!-- Alamat Kota Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alamat_kota', 'Alamat Kota:') !!}
    {!! Form::number('alamat_kota', null, ['class' => 'form-control']) !!}
</div>

<!-- Idpegawai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idpegawai', 'Idpegawai:') !!}
    {!! Form::number('idpegawai', null, ['class' => 'form-control']) !!}
</div>

<!-- Pid Organisasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pid_organisasi', 'Pid Organisasi:') !!}
    {!! Form::number('pid_organisasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Gedung Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kode_gedung', 'Kode Gedung:') !!}
    {!! Form::text('kode_gedung', null, ['class' => 'form-control']) !!}
</div>

<!-- Kode Ruang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kode_ruang', 'Kode Ruang:') !!}
    {!! Form::text('kode_ruang', null, ['class' => 'form-control']) !!}
</div>

<!-- Penanggung Jawab Field -->
<div class="form-group col-sm-6">
    {!! Form::label('penanggung_jawab', 'Penanggung Jawab:') !!}
    {!! Form::number('penanggung_jawab', null, ['class' => 'form-control']) !!}
</div>

<!-- Umur Ekonomis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('umur_ekonomis', 'Umur Ekonomis:') !!}
    {!! Form::number('umur_ekonomis', null, ['class' => 'form-control']) !!}
</div>

<!-- Action Field -->
<div class="form-group col-sm-6">
    {!! Form::label('action', 'Action:') !!}
    {!! Form::text('action', null, ['class' => 'form-control']) !!}
</div>

<!-- History At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('history_at', 'History At:') !!}
    {!! Form::date('history_at', null, ['class' => 'form-control','id'=>'history_at']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#history_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inventarisHistories.index') !!}" class="btn btn-default">Cancel</a>
</div>
