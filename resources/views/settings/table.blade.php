@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped ']) !!}

<script>        
    function updateEnv(id, self) {
        console.log('updating')
        __ajax({
            method: 'PUT',
            url: $("[base-path]").val() + "/api/settings/" + id,
            dataType: 'json',
            data: {
                nilai: $(self).prev('input').val()
            }
        }).then(() => {
            $(self).removeClass('btn-warning').addClass('btn-success')
        })
    }

    function stageChange(self) {
        $(self).next('span.fa').removeClass('btn-success').addClass('btn-warning')
    }
</script>
@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}

    
@endsection