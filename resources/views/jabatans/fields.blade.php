<!-- Nama Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Field -->
<div class="form-group col-sm-6 row">
    {!! Form::label('jenis', 'Jenis:') !!}
    {!! Form::select('jenis',[], null, ['class' => 'form-control']) !!}
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