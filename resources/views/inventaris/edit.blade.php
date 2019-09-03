@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventaris
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inventaris, ['route' => ['inventaris.update', $inventaris->id], 'method' => 'patch']) !!}

                        @include('inventaris.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection