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
                   {!! Form::model($inventaris, ['route' => ['inventaris.update', $inventaris->id], 'method' => 'patch']) !!}

                        @include('inventaris.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection