@extends('layouts.app')

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header bg-blue">
                Edit
            </div>
           <div class="box-body">
               <div class="">
                   {!! Form::model($inventaris, ['route' => ['inventaris.update', $inventaris->id], 'method' => 'patch', 'id' => 'form-inventaris']) !!}

                        @include('inventaris.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       <?php 
            $idPostfix = rand(1, 1000000)."ajax";
        ?>
       @include('inventaris.modal')
   </div>
@endsection