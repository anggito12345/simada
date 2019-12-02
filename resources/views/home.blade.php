@extends('layouts.app')

@section('content')
<div class="container p-5">
    <h4>Mutasi:</h4>
    @if(c::is([],[],[0]))    
    <div class="row">
        <div class="col-4">
            <div class="info-box" onclick="$('#table-mutasi-masuk').DataTable().ajax.reload(); showMutasiMasuk()">
                <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Baru</span>
                    <span class="info-box-number" data-bind="text: viewModel.data.count().step1"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-4">
            <div class="info-box">
                <span class="info-box-icon bg-light-blue"><i class="fa fa-recycle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Persetujuan BPKAD</span>
                    <span class="info-box-number" data-bind="text: viewModel.data.count().step2"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-4">
            <div class="info-box">
                <span class="info-box-icon bg-yellow" onclick="$('#table-mutasi-konfirmasi').DataTable().ajax.reload(); $('#modal-mutasi-konfirmasi').modal('show')"><i class="fa fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Konfirmasi Mutasi</span>
                    <span class="info-box-number" data-bind="text: viewModel.data.count().step3"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    @endif
    @if(c::is([],[],[-1]))
    <div class="row">
        <div class="col-4">
            <div class="info-box" onclick="$('#table-mutasi-bpkad').DataTable().ajax.reload(); $('#modal-mutasi-bpkad').modal('show')">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Persetujuan</span>
                    <span class="info-box-number" data-bind="text: viewModel.data.count().step2"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>        
    </div>
    @endif

    <h4>Penghapusan:</h4> 
    @if(c::is([],[],[0]))     
    <div class="row">
        <div class="col-4">
            <div class="info-box" onclick="$('#table-penghapusan-konfirmasi').DataTable().ajax.reload(); $('#modal-penghapusan-konfirmasi').modal('show')">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Konfirmasi Penghapusan</span>
                    <span class="info-box-number" data-bind="text: viewModel.data.countPenghapusan().step2"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>        
    </div> 
    @elseif(c::is([],[],[-1]))
    <div class="row">
        <div class="col-4">
            <div class="info-box" onclick="$('#table-penghapusan-bpkad').DataTable().ajax.reload(); $('#modal-penghapusan-bpkad').modal('show')">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Persetujuan</span>
                    <span class="info-box-number" data-bind="text: viewModel.data.countPenghapusan().step1"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>        
        <div class="col-4">
            <div class="info-box" onclick="$('#table-penghapusan-validasi').DataTable().ajax.reload(); $('#modal-penghapusan-validasi').modal('show')">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Validasi Penghapusan</span>
                    <span class="info-box-number" data-bind="text: viewModel.data.countPenghapusan().step3"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>        
    </div>
    @endif
</div>

<div class="modal fade" id="modal-mutasi-masuk" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mutasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="table-mutasi">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="approvementMutasi('STEP-1')">Konfirmasi</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-mutasi-bpkad" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mutasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="table-mutasi-bpkad">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="beforeApproveStep2()">Setujui</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-penghapusan-bpkad" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="table-penghapusan-bpkad">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="beforeApproveBPKADPenghapusan()">Setujui</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-penghapusan-konfirmasi" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="table-penghapusan-konfirmasi">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="beforeApproveKonfirmasiPenghapusan()">Setujui</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-penghapusan-validasi" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Validasi Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="table-penghapusan-validasi">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="approvementValidasiPenghapusan()">Setujui</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

<div class="modal fade" id="modal-mutasi-konfirmasi" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mutasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="table-mutasi-konfirmasi">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="approvementMutasiStep3('STEP-3')">Konfirmasi</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@section('before_pages')
<script src="<?= url('js/services/inventaris_masuk.js?key='.sha1(time())) ?>"></script>
@endsection

@endsection