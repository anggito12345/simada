@extends('layouts.app')

@section('content')
<style>
    .tab-header {
        background: #039151;
        min-height: 2.5rem;
        width: 100%;
        padding: 1rem 2.5rem;
    }

    .item {
        display: inline-block;
        color: #d1e0d9;
        cursor: pointer;
        font-weight: 500;
    }

    .item:hover {
        color: #edf5f1;
    }

    .item.active {
        color: white;
        font-weight: 700;
    }

    .item:not(:first-child) {
        margin-left: .75rem;
    }


    .info-box .flag-active {
        display: none;
    }

    .info-box.active .flag-active {
        display: inline-block;
    }
</style>
<div class="tab-header">
    <div class="item" data-bind="{ 
            click: viewModel.clickEvent.setCurrentTab.bind(this, 'mutasi'), 
            class: viewModel.data.currentTab() === 'mutasi' ? 'active' : ''
        }">
        Mutasi
    </div>
    <div class="item" data-bind="{ 
            click: viewModel.clickEvent.setCurrentTab.bind(this, 'penghapusan'), 
            class: viewModel.data.currentTab() === 'penghapusan' ? 'active' : ''
        }">
        Penghapusan
    </div>
</div>
<div class="container p-3">
    @if(c::is([],[],[0, 1]))
    <div class="row" data-bind="if: viewModel.data.currentTab() === 'mutasi'">
        <div class="col-md-4">
            <div class="info-box" data-bind="{
                    click: viewModel.clickEvent.setCurrentHighlight.bind(this, 'mutasi-masuk'),
                    class: viewModel.data.currentHighlight() === 'mutasi-masuk' ? 'active' : ''
                }">
                <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        Baru
                        <i class="flag-active fa fa-circle text-success"></i>
                    </span>
                    <span class="info-box-number" data-bind="text: viewModel.data.count().step1"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <!-- <div class="col-md-4">
            <div class="info-box" data-bind="{
                    click: viewModel.clickEvent.setCurrentHighlight.bind(this, 'mutasi-bpkad'),
                    class: viewModel.data.currentHighlight() === 'mutasi-bpkad' ? 'active' : ''
                }">
                <span class="info-box-icon bg-light-blue"><i class="fa fa-recycle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        Persetujuan BPKAD
                        <i class="flag-active fa fa-circle text-success"></i>
                    </span>
                    <span class="info-box-number" data-bind="text: viewModel.data.count().step2"></span>
                </div>
            </div>
        </div> -->
        <div class="col-md-4">
            <div class="info-box" data-bind="{
                    click: viewModel.clickEvent.setCurrentHighlight.bind(this, 'mutasi-konfirmasi'),
                    class: viewModel.data.currentHighlight() === 'mutasi-konfirmasi' ? 'active' : ''
                }">
                <span class="info-box-icon bg-yellow">
                    <i class="fa fa-shopping-cart"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">Konfirmasi Mutasi
                        <i class="flag-active fa fa-circle text-success"></i>
                    </span>
                    <span class="info-box-number" data-bind="text: viewModel.data.count().step3"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    @endif
    @if(c::is([],[],[-1]))
    <div class="row" data-bind="if: viewModel.data.currentTab() === 'mutasi'">
        <div class="col-md-4">
            <div class="info-box" data-bind="{
                    click: viewModel.clickEvent.setCurrentHighlight.bind(this, 'mutasi-bpkad'),
                    class: viewModel.data.currentHighlight() === 'mutasi-bpkad' ? 'active' : ''
                }">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Persetujuan
                        <i class="flag-active fa fa-circle text-success"></i>
                    </span>
                    <span class="info-box-number" data-bind="text: viewModel.data.count().step2"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    @endif

    @if(c::is([],[],[0, 1]))
    <div class="row" data-bind="if: viewModel.data.currentTab() === 'penghapusan'">
        <div class="col-md-4">
            <div class="info-box" data-bind="{
                    click: viewModel.clickEvent.setCurrentHighlight.bind(this, 'penghapusan-konfirmasi'),
                    class: viewModel.data.currentHighlight() === 'penghapusan-konfirmasi' ? 'active' : ''
                }">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Konfirmasi Penghapusan
                        <i class="flag-active fa fa-circle text-success"></i>
                    </span>
                    <span class="info-box-number" data-bind="text: viewModel.data.countPenghapusan().step2"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    @elseif(c::is([],[],[-1]))
    <div class="row" data-bind="if: viewModel.data.currentTab() === 'penghapusan'">
        <div class="col-md-4">
            <div class="info-box" data-bind="{
                    click: viewModel.clickEvent.setCurrentHighlight.bind(this, 'penghapusan-bpkad'),
                    class: viewModel.data.currentHighlight() === 'penghapusan-bpkad' ? 'active' : ''
                }">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Persetujuan
                        <i class="flag-active fa fa-circle text-success"></i>
                    </span>
                    <span class="info-box-number" data-bind="text: viewModel.data.countPenghapusan().step1"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box" data-bind="{
                    click: viewModel.clickEvent.setCurrentHighlight.bind(this, 'penghapusan-validasi'),
                    class: viewModel.data.currentHighlight() === 'penghapusan-validasi' ? 'active' : ''
                }">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Validasi Penghapusan
                        <i class="flag-active fa fa-circle text-success"></i>
                    </span>
                    <span class="info-box-number" data-bind="text: viewModel.data.countPenghapusan().step3"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    @endif
</div>

<div class="container">
    <div class="box content" data-bind="visible: viewModel.data.currentHighlight() !== ''">
        <div class="box-body ">
            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'mutasi-masuk'">
                <table class="table table-striped" id="table-mutasi-masuk">
                </table>
                                
                <button type="button" class="btn btn-primary" onclick="approvementMutasi('STEP-1')">Konfirmasi</button>
            </div>
            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'mutasi-bpkad'">
                <table class="table table-striped" id="table-mutasi-bpkad">
                </table>

                @if(c::is([],[],[-1]))
                    <button type="button" class="btn btn-primary" onclick="beforeApproveStep2()">Setujui</button>
                @endif
            </div>

            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'mutasi-konfirmasi'">
                <table class="table table-striped " id="table-mutasi-konfirmasi">
                </table>

                <button type="button" class="btn btn-primary" onclick="approvementMutasiStep3('STEP-3')">Konfirmasi</button>
            </div>

            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'penghapusan-konfirmasi'">
                <table class="table table-striped" id="table-penghapusan-konfirmasi">
                </table>

                <button type="button" class="btn btn-primary" onclick="beforeApproveKonfirmasiPenghapusan()">Setujui</button>
            </div>

            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'penghapusan-bpkad'">
                <table class="table table-striped" id="table-penghapusan-bpkad">
                </table>

                <button type="button" class="btn btn-primary" onclick="beforeApproveBPKADPenghapusan()">Setujui</button>
            </div>
            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'penghapusan-validasi'">
                <table class="table table-striped" id="table-penghapusan-validasi">
                </table>

                <button type="button" class="btn btn-primary" onclick="approvementValidasiPenghapusan()">Setujui</button>
            </div>
        </div>

    </div>
</div>




<div class="modal fade" id="modal-mutasi-bpkad-form" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mutasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    {!! Form::open(['id' => 'form-bpkad-mutasi' ]) !!}
                    <div class="form-group">
                        <label>Dokumen Persetujuan:</label>
                        {!! Form::file('dokumen', ['class' => 'form-control', 'id' => 'dokumen']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="approvementMutasiStep2('STEP-2')">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-penghapusan-konfirmasi-form" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    {!! Form::open(['id' => 'form-konfirmasi-penghapusan' ]) !!}
                    <div class="form-group">
                        <label>Berita Acara:</label>
                        {!! Form::file('dokumen', ['class' => 'form-control', 'id' => 'berita-acara']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="approvementKonfirmasiPenghapusan('STEP-2')">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-penghapusan-bpkad-form" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    {!! Form::open(['id' => 'form-bpkad-penghapusan' ]) !!}
                    <div class="form-group">
                        <label>Nomor Surat:</label>
                        {!! Form::text('nomor-persetujuan-step1', '', ['class' => 'form-control', 'id' => 'nomor-persetujuan-step1']) !!}
                    </div>
                    <div class="form-group">
                        <label>Dokumen Persetujuan:</label>
                        {!! Form::file('dokumen', ['class' => 'form-control', 'id' => 'dokumen-penghapusan']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="approvementPenghapusanBPKAD('STEP-2')">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@section('before_pages')
<script src="<?= url('js/services/inventaris_masuk.js?key=' . sha1(time())) ?>"></script>
@endsection

@endsection