@extends('layouts.app')

@section('content')
    <script>
         function onSensus() {
            if ($("#table-inventaris").DataTable().rows('.selected').count()!= 1 ) {
                swal.fire({
                    type: 'error',
                    text: 'Silahkan pilih 1 yang ingin disensus',
                    title: 'Ubah'
                })
            } else {
                $('#modal-sensus').modal('show')
            }
        }
    </script>
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
                @include('inventaris.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>

    <div class="modal" id="modal-sensus" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sensus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        Sensus
                    </label>
                    <select type="text" class="form-control" id="sensus-dd"
                        data-bind="value: sensus.data.status_barang" placeholder="Pilih Status Barang" >
                        <option>Pilih Status Barang </option>
                        <option value="Ubah Satuan">Ubah Satuan</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                    </select>
                </div>

                <div class="ubahsatuan-form" data-bind="if: sensus.data.status_barang() == 'Ubah Satuan'">
                    <div class="btn btn-primary btn-block">
                        Pisah
                    </div>

                    <div class="btn btn-primary btn-block">
                        Gabung
                    </div>
                </div>

                <div class="ubahsatuan-form" data-bind="if: sensus.data.status_barang() == 'Tidak Ada'">
                    <div class="btn btn-primary btn-block">
                        Sudah dihapuskan
                    </div>

                    <div class="btn btn-primary btn-block">
                        Hilang
                    </div>

                    <div class="btn btn-primary btn-block">
                        Tidak diketahui keberadaannya
                    </div>
                </div>


            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts_2 ')
<script>

   $(document).ready(() => {

        $('#sensus-dd').select2({
            placeholder: "Pilih Status Barang",
        })

        $('#ubahsatuan-dd').select2({
            placeholder: "Pilih Status Barang",
        })
   })
</script>
@endsection
