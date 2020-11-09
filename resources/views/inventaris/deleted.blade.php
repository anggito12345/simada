@extends('layouts.app')

@section('content')
<?php

?>
<section class="content-header">
  <h3 class="pull-left">{{ Breadcrumbs::render() }}</h3>
  <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('inventaris.create') !!}">Add New</a>
        </h1> -->
</section>
<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')
  <div class="box box-primary">
    <div class="box-body">
      <label class="advance_filter_toggle text-info" style="cursor: pointer" onclick="viewModel.clickEvent.toggleAdvanceFilter()">
        Advance Filter
        <i class="fa fa-filter"></i>
      </label>
      <div class="advance_body">
        @include('inventaris.table_filter')
      </div>

      <div class="clearfix"></div>

      <div class="box box-primary">
        <div class="box-body">
          @include('inventaris.table')
        </div>
      </div>
    </div>
  </div>


  <div class="text-center">

  </div>
</div>
@endsection


