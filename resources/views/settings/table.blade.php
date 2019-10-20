@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}

    <script>
        function updateEnv(id, self) {
            __ajax({
                method: 'PUT',
                url: $("[base-path]").val() + "/api/settings/" + id,
                dataType: 'json',
                data: {
                    nilai: $(self).val()
                }
            }).then(() => {
                $(self).next('span.fa').removeClass('text-warning').addClass('text-success')
            })
        }

        function stageChange(self) {
            $(self).next('span.fa').removeClass('text-success').addClass('text-warning')
        }
    </script>
@endsection