@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Lokasi</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('alamats.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-4 form-group">
                        {!! Form::label('jenis', 'Jenis:') !!}
                        {!! Form::select('jenis', \App\Models\BaseModel::$jenisKotaDs, null, ['class' => 'form-control', 'placeholder' => 'Silahkan pilih', 'onchange' => '$("#table-alamat").DataTable().ajax.reload();']) !!}       
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('alamats.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

