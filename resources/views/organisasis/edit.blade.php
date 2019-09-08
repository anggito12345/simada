@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Organisasi
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($organisasi, ['route' => ['organisasis.update', $organisasi->id], 'method' => 'patch']) !!}

                        @include('organisasis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection