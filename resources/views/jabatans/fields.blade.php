<!-- Nama Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nama', 'Nama Jabatan Aset:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Jabatan -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nama_jabatan', 'Nama Jabatan:') !!}
    {!! Form::text('nama_jabatan', null, ['class' => 'form-control']) !!}
</div>

<!-- Kelompok Jabatan -->
<div class="form-group col-sm-6 row">
    {!! Form::label('kelompok', 'Kelompok Jabatan:') !!}
    {!! Form::select('kelompok', \App\Models\BaseModel::$kelompokJabatanDs, null, ['class' => 'form-control', 'placeholder' => 'Mohon Pilih']) !!}
</div>

<!-- Nama Jabatan -->
<div class="form-group col-sm-6 row">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::number('level', null, ['class' => 'form-control']) !!}
    <div class="alert alert-info">
        <i class="fa fa-info" ></i>
        Level yang lebih besar tidak bisa melihat level yang lebih kecil!
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('jabatans.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script>
    $('#jenis').select2({
        ajax: {
            url: "<?= url('api/jenisopds') ?>",
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
</script>

@if(isset($jabatan))
<script>
    App.Helpers.defaultSelect2($('#jenis'), `${$('[base-path]').val()}/api/jenisopds/<?= $jabatan->jenis ?>`,"id","nama",() => {        
    })
</script>
@endif
@endsection