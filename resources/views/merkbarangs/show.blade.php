@extends('layouts.app')

@section('content')
   <section class="content-header">
        <h3 class="pull-left">{{ Breadcrumbs::render() }}</h3>
        <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('inventaris.create') !!}">Add New</a>
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="container container-view" style="padding-left: 20px">
                    @include('merkbarangs.show_fields')
                   
                </div>
                <a href="{!! route('merkbarangs.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@endsection
