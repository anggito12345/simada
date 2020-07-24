@extends('layouts.app')

<?php
    $availableImport = [
        [
            "name" => "Inventaris",
            "path" => ""
        ]
    ];
?>

@section('content')
    <section class="content-header">
        <h3 class="pull-left">{{ Breadcrumbs::render() }}</h3>
        <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('inventaris.create') !!}">Add New</a>
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                <table class="table table-striped" id="datatable-import">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availableImport as $imp)
                        <tr>
                            <td>{!! $imp["name"] !!}</td>
                            <td>
                                <div class="btn btn-primary" onclick="showForm()">IMPORT</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
        <div class="text-center">

        </div>
    </div>

    <div class="modal" id="modal-import" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Import</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="<?= route('import.inventaris') ?>" id="form-import" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Browse:</label>

                    {{ Form::file('file') }}

                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="submitForm()">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
        </div>
    </div>
    </div>
@endsection
@section("scripts")
<script>
    function showForm() {
        $("#modal-import").modal('show')
    }

    function submitForm() {
        $("#form-import").submit()
    }


    $("#datatable-import").DataTable()
</script>
@endsection

