@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['id' => 'pemanfaatans-table','width' => '100%', 'class' => 'table table-striped ']) !!}



@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection