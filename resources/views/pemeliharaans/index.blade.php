@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h3 class="pull-left">{{ Breadcrumbs::render() }}</h3>
       
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-4">     
                        {{ Form::label('Draft') }}                   
                        {{ Form::select('draft', ['Tidak', 'Ya'], null, ['class' => 'form-control', 'onchange' => 'viewModel.changeEvent.refreshDatatable()'])}}
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix" />
        
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body table-content">
                    @include('pemeliharaans.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

