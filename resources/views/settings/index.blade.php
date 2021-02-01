@extends('layouts.app')

@section('content')
    <style>
        .info-box:hover {
            -webkit-box-shadow: -2px -2px 19px -2px rgba(0,0,0,0.75);
            -moz-box-shadow: -2px -2px 19px -2px rgba(0,0,0,0.75);
            box-shadow: -2px -2px 19px -2px rgba(0,0,0,0.75); 
        }

        .info-box {
            cursor: pointer;
        }
    </style>
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
        <div class="row">
            <div class="col-6">
                <div class="info-box" onclick="requestTo('{!! env('SERVICE_PENYUSUTAN', false) !!}/api/penyusutan/manual')">
                    <span class="info-box-icon bg-green"><i class="fa fa-arrow-down"></i></span>
                    <div class="info-box-content">
                        Manual Penyusutan
                    </div>
                </div>
            </div>
        </div>
        

        <div class="box box-primary">
            <div class="box-body">
                    @include('settings.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@section('scripts_2')
<script>
    function requestTo(to) {
        __ajax({
            method: 'GET',
            url: to,
        }).then(() => {
            swal.fire({
                type: 'success',
                text: 'Success'
            })
        })
    }
</script>
@endsection



