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
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                    <?php 
                        $idPostfix = rand(1, 1000000)."non-ajax";
                    ?>
                   {!! Form::model($barang, ['route' => ['barangs.update', $barang->id], 'method' => 'patch']) !!}

                        @include('barangs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       <?php 
            $idPostfix = rand(1, 1000000)."ajax";
        ?>
        @include('barangs.modal')
   </div>
@endsection