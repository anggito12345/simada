@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Rka Detil
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($rkaDetil, ['route' => ['rkaDetils.update', $rkaDetil->id], 'method' => 'patch']) !!}

                        @include('rka_detils.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection