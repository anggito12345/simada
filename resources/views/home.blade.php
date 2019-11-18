@extends('layouts.app')

@section('content')
<div class="container p-5">
    <div class="row">     
        <div class="col-3">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Mutasi Baru Masuk</span>
                <span class="info-box-number">{!! \App\Repositories\inventaris_mutasiRepository::countDestFirst() !!}</span>
                </div>
                <!-- /.info-box-content -->
            </div>   
        </div>
        <div class="col-3">
            <div class="info-box">
                <span class="info-box-icon bg-light-blue"><i class="fa fa-recycle"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Mutasi Sedang Proses Persetujuan </span>
                <span class="info-box-number">0</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
</div>
@endsection
