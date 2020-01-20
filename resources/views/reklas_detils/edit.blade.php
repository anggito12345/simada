@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Reklas Detil
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($reklasDetil, ['route' => ['reklasDetils.update', $reklasDetil->id], 'method' => 'patch']) !!}

                        @include('reklas_detils.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection