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
            <div class="box-header">
                Inventaris
            </div>
            <div class="box-body">
                <input type='file' id='fileimport' onchange='doImport()' style="display: none;" />
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>*</h3>

                                <p>Tanah</p>
                            </div>
                            <div class="icon">
                                <!-- <img src="{!! asset('images/icons/icon_new_list.png') !!}" width=40 class="opacity-8" /> -->
                                <i class="ion ion-earth"></i>
                            </div>
                            <a href="#" onclick="doUpload('inventaris', 'detil_tanah')" class="small-box-footer">Import <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>*</h3>

                                <p>Bangunan</p>
                            </div>
                            <div class="icon">
                                <!-- <img src="{!! asset('images/icons/icon_new_list.png') !!}" width=40 class="opacity-8" /> -->
                                <i class="fa fa-building"></i>
                            </div>
                            <a href="#" onclick="doUpload('inventaris', 'detil_bangunan')" class="small-box-footer">Import <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>*</h3>

                                <p>Jalan</p>
                            </div>
                            <div class="icon">
                                <!-- <img src="{!! asset('images/icons/icon_new_list.png') !!}" width=40 class="opacity-8" /> -->
                                <i class="fa fa-road"></i>
                            </div>
                            <a href="#" onclick="doUpload('inventaris', 'detil_jalan')" class="small-box-footer">Import <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>*</h3>

                                <p>Konstruksi</p>
                            </div>
                            <div class="icon">
                                <!-- <img src="{!! asset('images/icons/icon_new_list.png') !!}" width=40 class="opacity-8" /> -->
                                <i class="ion ion-ios-albums"></i>
                            </div>
                            <a href="#" onclick="doUpload('inventaris', 'detil_konstruksi')" class="small-box-footer">Import <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>*</h3>

                                <p>Mesin</p>
                            </div>
                            <div class="icon">
                                <!-- <img src="{!! asset('images/icons/icon_new_list.png') !!}" width=40 class="opacity-8" /> -->
                                <i class="fa fa-car"></i>
                            </div>
                            <a href="#" onclick="doUpload('inventaris', 'detil_mesin')" class="small-box-footer">Import <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>*</h3>

                                <p>Aset</p>
                            </div>
                            <div class="icon">
                                <!-- <img src="{!! asset('images/icons/icon_new_list.png') !!}" width=40 class="opacity-8" /> -->
                                <i class="ion ion-ios-albums"></i>
                            </div>
                            <a href="#" onclick="doUpload('inventaris', 'detil_aset')" class="small-box-footer">Import <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                Master Barang
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>*</h3>

                                <p>Update</p>
                            </div>
                            <div class="icon">
                                <!-- <img src="{!! asset('images/icons/icon_new_list.png') !!}" width=40 class="opacity-8" /> -->
                                <i class="ion ion-ios-bookmarks"></i>
                            </div>
                            <a href="#" onclick="doUpload('master-barang', 'update')" class="small-box-footer">Import <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header">
                Master Organisasi
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>*</h3>

                                <p>Update</p>
                            </div>
                            <div class="icon">
                                <!-- <img src="{!! asset('images/icons/icon_new_list.png') !!}" width=40 class="opacity-8" /> -->
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="#" onclick="doUpload('master-organisasi', 'update')" class="small-box-footer">Import <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
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
    let typeImport = '';
    let actImport = '';

    function doUpload(type, act) {
        typeImport = type;
        actImport = act;
        $('#fileimport').click()
    }

    function doImport() {
        if (typeImport != '' && actImport != '') {
            
            let data = new FormData();

            data.append('fileimport', document.getElementById('fileimport').files[0])
            __ajax({
                url: `${$("[base-path]").val()}/api/import?type=${typeImport}&act=${actImport}`,
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
            }).then((d) => {
                swal.fire({
                    type: "success",
                    text: "Berhasil import data!",
                    onClose: () => {
                        // $("#table-inventaris").DataTable().ajax.reload();
                    }
                })
            })
        }
    }
</script>
@endsection

