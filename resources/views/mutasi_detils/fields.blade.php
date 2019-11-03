

<!-- Inventaris Field -->
<div class="form-group col-sm-12">
    {!! Form::label('inventaris', 'Inventaris:') !!}
    {!! Form::select('inventaris', [], null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formMutasiDetil().inventaris']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'data-bind' => 'value: viewModel.data.formMutasiDetil().keterangan']) !!}
</div>

<script>
    viewModel.jsLoaded.subscribe(() => {
        $('#inventaris').select2({
            ajax: {
                url: "<?= url('api/inventaris') ?>",
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
    })
</script>