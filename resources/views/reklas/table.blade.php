@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['id' => 'reklas-table', 'width' => '100%', 'class' => 'table table-striped ']) !!}

@section('scripts')
    <script type="text/javascript">
        function onDokumenReklasGetFiles(foreignId, callback) {
            return __ajax({
                method: 'GET',
                url: "<?= url('api/system_uploads') ?>",
                data: {
                    jenis: 'dokumen',
                    foreign_field: 'id',
                    foreign_id: foreignId,
                    foreign_table: 'reklas',
                },  
            }).then((files) => {                
                dokumenReklas.fileList(files);
                callback();
            });
        }
    </script>
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection