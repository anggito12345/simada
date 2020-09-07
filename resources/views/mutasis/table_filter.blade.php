<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            {{ Form::label('Draft') }}
            {{ Form::select('draft', ['Tidak', 'Ya'], null, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.refreshDatatable()'])}}
        </div>
        @if (c::is('',[],[-1]))
            <div class="col-md-4">
                {!! Form::label('opd_asal', 'OPD Asal') !!}
                {!! Form::select('opd_asal', [] , "", ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.refreshDatatable()']) !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('opd_tujuan', 'OPD Tujuan') !!}
                {!! Form::select('opd_tujuan', [] , "", ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.refreshDatatable()']) !!}
            </div>
        @endif
    </div>
</div>

<script>
    viewModel.jsLoaded.subscribe(() => {
        @if (c::is('',[],[-1]))
            $('#opd_asal, #opd_tujuan').select2({
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
