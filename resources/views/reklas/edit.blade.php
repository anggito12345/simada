@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Reklas
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($reklas, ['route' => ['reklas.update', $reklas->id], 'method' => 'patch']) !!}

                        @include('reklas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection