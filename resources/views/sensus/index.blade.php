@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h3 class="pull-left">{{ Breadcrumbs::render() }}</h3>
        <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('inventaris.create') !!}">Add New</a>
        </h1> -->
    </section>
    <?php
    ?>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#inventaris">Inventaris</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#sensus">Sensus</a>
                    </li>
                </ul>
                <br />
                <div class="tab-content">
                    <div class="tab-pane container active" id="inventaris">
                        @include('inventaris.table')
                    </div>
                    <div class="tab-pane container fade" id="sensus">
                        <div class="row">
                            <div class="col-md-4">
                                {{ Form::label('jenis_sensus', 'Jenis Sensus:') }}
                                {{ Form::select('jenis_sensus', Constant::$SENSUS_STATUS_01, 0, ['class' => 'form-control', 'onchange' => 'sensus.methods.reloadGrid()', 'style' => 'width:100%']) }}
                            </div>
                        </div>
                        <br />
                        <table id="table-sensus" class="table table-responsive" style="width:100%">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

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
                <div class="form-group" data-bind="if: sensus.data.step() == 1">
                    <label>
                        Sensus
                    </label>
                    <select type="text" class="form-control" id="sensus-dd" data-bind="value: sensus.data.form.status_barang" placeholder="Pilih Status Barang" >
                        <option>Pilih Status Barang</option>

                        @foreach (Constant::$SENSUS_STATUS_01 as $index => $sensus_status)
                            <option value="{!! $index !!}">{!! $sensus_status !!}</option>
                        @endforeach
                    </select>
                </div>
                {{-- options tidak ada --}}
                <div class="ubahsatuan-form" data-bind="if: sensus.data.form.status_barang() == 1 && sensus.data.step() == 2">
                    @foreach (Constant::$SENSUS_STATUS_02 as $index => $sensus_status)
                        <div class="btn btn-primary btn-block"  onclick="sensus.methods.showSkForm('{!! $index !!}', 'status_ubah_satuan')">
                            {!! $sensus_status !!}
                        </div>
                    @endforeach

                    <a href="#" onclick="sensus.methods.backToStep(1)" class="btn btn-danger btn-block"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                </div>
                {{-- options ubah satuan --}}
                <div class="ubahsatuan-form" data-bind="if: sensus.data.form.status_barang() == 0 && sensus.data.step() == 2">
                    @foreach (Constant::$SENSUS_STATUS_03 as $index => $sensus_status)
                        <div class="btn btn-primary btn-block" onclick="sensus.methods.showSkForm('{!! $index !!}', 'status_barang_hilang')">
                            {!! $sensus_status !!}
                        </div>
                    @endforeach

                    <a href="#" onclick="sensus.methods.backToStep(1)" class="btn btn-danger btn-block"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                </div>
                <div class="ubahsatuan-form" data-bind="visible: sensus.data.step() == 3">
                    <div class="form-group">
                        <label>
                            No SK.
                        </label>
                        <input type='text' class="form-control" data-bind="value: sensus.data.form.no_sk" />
                    </div>
                    <div class="form-group">
                        <label>
                            Tgl SK.
                        </label>
                        <input type='text' id="tgl_sk" class="form-control" data-bind="value: sensus.data.form.tgl_sk" />
                    </div>
                    <input type="file" id="file-sensus-sk" />
                    <a href="#" onclick="sensus.methods.backToStep(2)"><i class="fa fa-arrow-left pull-left"></i>&nbsp; Back</a>
                    <div class="btn btn-success" style="float:right" onclick="sensus.methods.storeSensus()">
                        Submit
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

        $("select[name=jenis_sensus]").select2()

        $('#sensus-dd').select2({
            placeholder: "Pilih Status Barang",
        })

        $('#ubahsatuan-dd').select2({
            placeholder: "Pilih Status Barang",
        })
   })
</script>
@endsection
