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
    <script type="text/javascript">
        function onPemeliharaanGetFiles(foreignId, callback) {
            return __ajax({
                method: 'GET',
                url: "<?= url('api/system_uploads') ?>",
                data: {
                    jenis: 'media',
                    foreign_field: 'id',
                    foreign_id: foreignId,
                    foreign_table: 'pemeliharaan',
                },  
            }).then((files) => {                
                mediaPemeliharaan.fileList(files);
                callback();
            });
        }
    </script>
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection