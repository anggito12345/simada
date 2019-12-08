@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped ']) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}

<script>
    function onLoadDataTable(e) {
        $(`#${e.sTableId} tbody`).on('click', 'td.details-control i', function (i, n) {
            var tr = $(this).closest('tr');
                var row = $(`#${e.sTableId}`).DataTable().row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    $(this).attr('class',$(this).attr('class').replace('minus-circle', 'plus-circle'))

                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    $(this).attr('class',$(this).attr('class').replace('plus-circle', 'minus-circle'))

                    $.get(`${$("[base-path]").val()}/partials/view.mutasi/${row.data().id}`).then((data) => {                                                

                        row.child(`<div class='container container-view'>${data}</div>`).show();
                    })
                }
        })
    }
</script>
@endsection