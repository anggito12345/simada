<!-- Kode Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('kode', 'Kode:') !!}
    {!! Form::text('kode', null, ['class' => 'form-control']) !!}
</div>

<!-- Pid Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('pid', 'Induk Organisasi:') !!}
    {!! Form::select('pid', [],  null, ['class' => 'form-control', 'onchange' => '$("#jenis").val("").trigger("change")']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Jabatan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('jabatans', 'Akses Jabatan:') !!}
    {!! Form::select('jabatans', \App\Models\jabatan::pluck('nama', 'id'), [], ['id' => 'jabatans', 'class' => 'form-control']) !!}
</div>

<!-- Jabatan Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::select('level', \App\Models\BaseModel::$kelompokJabatanDs, null, ['id' => 'jabatans', 'class' => 'form-control']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Aktif Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('aktif', 'Aktif:') !!} &nbsp;
    <div class="radio">
        {!! Form::radio('aktif', 1, isset($organisasi) ? $organisasi->aktif == 1 : false) !!} Ya
        {!! Form::radio('aktif', 0, isset($organisasi) ? $organisasi->aktif == 0 : false) !!} Tidak
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('organisasis.index') !!}" class="btn btn-default">Batal</a>
</div>


@section('scripts')
<script>
    $('#pid').select2({
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
    
  
    $('#jabatans').select2({    
        theme: 'bootstrap' ,
    })
</script>

@if(isset($organisasi))
<script>
    App.Helpers.defaultSelect2($('#pid'), `${$('[base-path]').val()}/api/organisasis/<?= $organisasi->pid ?>`,"id","nama",() => {          
        $('#jabatans').select2().val(<?= json_encode($organisasi->jabatans) ?>).trigger('change')
    })
</script>
@endif
@endsection