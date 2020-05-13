@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped ']) !!}

@section('scripts')
    <script>
        function onImportRKA() {
            alert('Mengambil data RKA dari eBudgeting');
     /*        __ajax({
                method: 'GET',
                url: `${$("[base-path]").val()}/api/inventaris-api/sum-harga-satuan`,
                data: recFilter
            }).then((d) => {
                $('.total_harga_satuan').html(d.all_page)
                $('.per_page_harga_satuan').html(d.per_page)

            }) */
        }
    </script>
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection

