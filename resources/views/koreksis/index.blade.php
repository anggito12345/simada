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
            @include('koreksis.table_filter')
        </div>

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('koreksis.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection
