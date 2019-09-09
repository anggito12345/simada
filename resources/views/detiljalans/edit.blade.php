@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detiljalan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($detiljalan, ['route' => ['detiljalans.update', $detiljalan->id], 'method' => 'patch']) !!}

                        @include('detiljalans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection