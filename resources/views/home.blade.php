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
        click: viewModel.clickEvent.setCurrentTab.bind(this, 'home-map'),
        class: viewModel.data.currentTab() === 'home-map' ? 'active' : ''
    }">
        <i class="fa fa-globe"></i>
    </div>
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
    {{-- @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
    <div class="item" data-bind="{
        click: viewModel.clickEvent.setCurrentTab.bind(this, 'sensus'),
        class: viewModel.data.currentTab() === 'sensus' ? 'active' : ''
    }">
        Sensus
    </div> --}}
    @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
    <div class="item" data-bind="{
            click: viewModel.clickEvent.setCurrentTab.bind(this, 'reklas'),
            class: viewModel.data.currentTab() === 'reklas' ? 'active' : ''
        }">
        Reklas
    </div>
    @endif
</div>

<div class="container-fluid p-3">
    <div class="row" data-bind="if: viewModel.data.currentTab() === 'home-map'">
        <div class="col-md-12">
            <div id="home-map-container" style="height: 100vh;"></div>
        </div>
    </div>

    @if(c::is('',[],[Constant::$GROUP_OPD_ORG, Constant::$GROUP_CABANGOPD_ORG]))
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
    @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
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

    @if(c::is('',[],[Constant::$GROUP_OPD_ORG, Constant::$GROUP_CABANGOPD_ORG]))
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
    @elseif(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
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

    @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
    <div class="row" data-bind="if: viewModel.data.currentTab() === 'sensus'">
        <div class="col-md-4">
            <div class="info-box" data-bind="{
                    click: viewModel.clickEvent.setCurrentHighlight.bind(this, 'sensus-bpkad'),
                    class: viewModel.data.currentHighlight() === 'sensus-bpkad' ? 'active' : ''
                }">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Persetujuan
                        <i class="flag-active fa fa-circle text-success"></i>
                    </span>
                    <span class="info-box-number" data-bind="text: viewModel.data.countSensus().step1"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    @endif

    @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
        <div class="row" data-bind="if: viewModel.data.currentTab() === 'reklas'">
            <div class="col-md-4">
                <div class="info-box" data-bind="{
                        click: viewModel.clickEvent.setCurrentHighlight.bind(this, 'reklas-bpkad'),
                        class: viewModel.data.currentHighlight() === 'reklas-bpkad' ? 'active' : ''
                    }">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Persetujuan
                        <i class="flag-active fa fa-circle text-success"></i>
                    </span>
                    <span class="info-box-number" data-bind="text: viewModel.data.countReklas().step1"></span>
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
                @if(c::is('',[],[Constant::$GROUP_OPD_ORG]))
                    <button type="button" class="btn btn-primary" onclick="approvementMutasi('STEP-1')">Konfirmasi</button>
                @endif
            </div>
            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'mutasi-bpkad'">
                <table class="table table-striped" id="table-mutasi-bpkad">
                </table>

                @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
                <div class="d-flex justify-content-center mt-5">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" onclick="beforeApproveStep2(true)">Setujui</button>
                        <button type="button" class="btn btn-danger" onclick="beforeApproveStep2(false)">Batalkan</button>
                    </div>
                </div>
                @endif
            </div>

            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'mutasi-konfirmasi'">
                <table class="table table-striped " id="table-mutasi-konfirmasi">
                </table>
                @if(c::is('',[],[Constant::$GROUP_OPD_ORG]))
                    <button type="button" class="btn btn-primary" onclick="approvementMutasiStep3('STEP-3')">Konfirmasi</button>
                @endif
            </div>

            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'penghapusan-konfirmasi'">
                <table class="table table-striped" id="table-penghapusan-konfirmasi">
                </table>
                @if(c::is('',[],[Constant::$GROUP_OPD_ORG]))
                    <button type="button" class="btn btn-primary" onclick="beforeApproveKonfirmasiPenghapusan()">Setujui</button>
                @endif
            </div>

            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'penghapusan-bpkad'">
                <table class="table table-striped" id="table-penghapusan-bpkad">
                </table>
                @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
                    <button type="button" class="btn btn-primary" onclick="beforeApproveBPKADPenghapusan()">Setujui</button>
                @endif
            </div>
            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'penghapusan-validasi'">
                <table class="table table-striped" id="table-penghapusan-validasi">
                </table>
                @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
                    <button type="button" class="btn btn-primary" onclick="beforeApproveValidasiPenghapusan()">Setujui</button>
                @endif
            </div>

            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'sensus-bpkad'">
                <table class="table table-striped" id="table-sensus-bpkad">
                </table>
                @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
                    <button type="button" class="btn btn-primary" onclick="beforeApproveBPKADSensus()">Setujui</button>
                @endif
            </div>

            <div class="panel-body" data-bind="visible: viewModel.data.currentHighlight() == 'reklas-bpkad'">
                <table class="table table-striped" id="table-reklas-bpkad">
                </table>
                @if(c::is('',[],[Constant::$GROUP_BPKAD_ORG]))
                    <button type="button" class="btn btn-primary" onclick="approvementReklas('STEP-1')">Setujui</button>
                @endif
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
                        {!! Form::file('dokumen', ['class' => 'form-control', 'id' => 'dokumen-persetujuan-mutasi-bpkad']) !!}
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


<div class="modal fade" id="modal-mutasi-bpkad-cancel-form" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mutasi Batal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    {!! Form::open(['id' => 'form-bpkad-mutasi-cancel' ]) !!}
                    <div class="form-group">
                        <label>Dokumen Pembatalan:</label>
                        {!! Form::file('dokumen', ['class' => 'form-control', 'id' => 'dokumen-mutasi-cancel']) !!}
                    </div>
                    <div class="form-group">
                        <label>Catatan Pembatalan:</label>
                        {!! Form::textarea('cancel_note', null, ['class' => 'form-control', 'id' => 'cancel_note', 'row' => 5]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="cancelMutasiStep2('STEP-2')">Submit</button>
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
                        <label>Nomor Berita Acara:</label>
                        {!! Form::text('nomor-berita-acara-step2', '', ['class' => 'form-control', 'id' => 'nomor-berita-acara-step2']) !!}
                    </div>
                    <div class="form-group">
                        <label>Tanggal:</label>
                        {!! Form::text('tglba', null, ['class' => 'form-control','id'=>'tglba']) !!}
                    </div>
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
                        <label>Tanggal:</label>
                        {!! Form::text('tglsp', null, ['class' => 'form-control','id'=>'tglsp']) !!}
                    </div>
                    <div class="form-group">
                        <label>Dokumen Persetujuan:</label>
                        {!! Form::file('dokumen', ['class' => 'form-control', 'id' => 'dokumen-penghapusan']) !!}
                    </div>
                    <!--
                    <label><strong>Dasar SK Gubernur</strong></label>
                    <div class="form-group">
                        <label>Nomor SK Gubernur:</label>
                        {!! Form::text('nosk', null, ['class' => 'form-control', 'id' => 'nosk']) !!}
                    </div> -->
                    <div class="form-group">
                        <label>Keterangan:</label>
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'id' => 'keterangan']) !!}
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

<div class="modal fade" id="modal-validasi-penghapusan-konfirmasi-form" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Validasi Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    {!! Form::open(['id' => 'form-validasi-penghapusan' ]) !!}
                    <label><strong>Dasar SK Gubernur</strong></label>
                    <div class="form-group">
                        <label>Nomor SK Gubernur:</label>
                        {!! Form::text('nosk', null, ['class' => 'form-control', 'id' => 'nosk']) !!}
                    </div>
                    <div class="form-group">
                        <label>Tanggal:</label>
                        {!! Form::text('tglsk', null, ['class' => 'form-control','id'=>'tglsk']) !!}
                    </div>
                    <div class="form-group">
                        <label>Dokumen:</label>
                        {!! Form::file('dokumen', ['class' => 'form-control', 'id' => 'dokumen-validasi-penghapusan']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="approvementValidasiPenghapusan()">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- sensus -->
<div class="modal fade" id="modal-sensus-bpkad-form" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sensus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    {!! Form::open(['id' => 'form-bpkad-sensus' ]) !!}
                    <div class="form-group">
                        <label>Dokumen Rekomendasi Pengisi:</label>
                        {!! Form::file('dokumen', ['class' => 'form-control', 'id' => 'dokumen-sensus-bpkad']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="approvementSensusBPKAD('STEP-1')">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@section('before_pages')
<script src="<?= url('js/services/inventaris_masuk.js?key=' . sha1(time())) ?>"></script>
@endsection

@endsection
