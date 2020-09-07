<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('Draft') }}
            {{ Form::select('draft', ['Tidak', 'Ya'], null, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.refreshDatatable()'])}}
        </div>
        @if (c::is('',[],[-1]))
            <div class="col-md-4">
                {!! Form::label('opd', 'OPD') !!}
                {!! Form::select('opd', [] , "", ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.refreshDatatable()']) !!}
            </div>
        @endif
    </div>
</div>

<script>
    viewModel.jsLoaded.subscribe(() => {
        @if (c::is('',[],[-1]))
            $('#opd').select2({
                ajax: {
                    url: "<?= url('api/organisasis') ?>",
                    dataType: 'json',
                    data: function(d) {
                        d.level = 0
                        return d;
                    },
                    processResults: function (data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data.data
                        };
                    }
                },
                theme: 'bootstrap' ,
            });
        @endif
    });
</script>
