@section('css')
    @include('layouts.datatables_css')
@endsection

@if(isset($isInventarisPage))
<?php 
$tableId = 'pemeliharaan-'.uniqid();
?>
@else
<?php 
$tableId = 'pemeliharaan-table';
?>
@endif

{!! $dataTable->table(['id' => 'pemeliharaan-table', 'width' => '100%', 'class' => 'table table-striped ']) !!}


@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection