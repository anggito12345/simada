<!-- Pidinventaris Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pidinventaris', 'Pidinventaris:') !!}
    {!! Form::number('pidinventaris', null, ['class' => 'form-control']) !!}
</div>

<!-- Konstruksi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('konstruksi', 'Konstruksi:') !!}
    {!! Form::text('konstruksi', null, ['class' => 'form-control']) !!}
</div>

<!-- Panjang Field -->
<div class="form-group col-sm-6">
    {!! Form::label('panjang', 'Panjang:') !!}
    {!! Form::number('panjang', null, ['class' => 'form-control']) !!}
</div>

<!-- Lebar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lebar', 'Lebar:') !!}
    {!! Form::number('lebar', null, ['class' => 'form-control']) !!}
</div>

<!-- Luas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('luas', 'Luas:') !!}
    {!! Form::number('luas', null, ['class' => 'form-control']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Idkota Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idkota', 'Idkota:') !!}
    {!! Form::number('idkota', null, ['class' => 'form-control']) !!}
</div>

<!-- Idkecamatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idkecamatan', 'Idkecamatan:') !!}
    {!! Form::number('idkecamatan', null, ['class' => 'form-control']) !!}
</div>

<!-- Idkelurahan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idkelurahan', 'Idkelurahan:') !!}
    {!! Form::number('idkelurahan', null, ['class' => 'form-control']) !!}
</div>

<!-- Koordinatlokasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('koordinatlokasi', 'Koordinatlokasi:') !!}
    {!! Form::text('koordinatlokasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Koordinattanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('koordinattanah', 'Koordinattanah:') !!}
    {!! Form::text('koordinattanah', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgldokumen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgldokumen', 'Tgldokumen:') !!}
    {!! Form::date('tgldokumen', null, ['class' => 'form-control','id'=>'tgldokumen']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tgldokumen').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Nodokumen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nodokumen', 'Nodokumen:') !!}
    {!! Form::text('nodokumen', null, ['class' => 'form-control']) !!}
</div>

<!-- Luastanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('luastanah', 'Luastanah:') !!}
    {!! Form::text('luastanah', null, ['class' => 'form-control']) !!}
</div>

<!-- Statustanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('statustanah', 'Statustanah:') !!}
    {!! Form::text('statustanah', null, ['class' => 'form-control']) !!}
</div>

<!-- Kodetanah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kodetanah', 'Kodetanah:') !!}
    {!! Form::text('kodetanah', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('detiljalans.index') !!}" class="btn btn-default">Cancel</a>
</div>
