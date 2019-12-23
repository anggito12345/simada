@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventaris Reklas
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inventarisReklas, ['route' => ['inventarisReklas.update', $inventarisReklas->id], 'method' => 'patch']) !!}

                        @include('inventaris_reklas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection