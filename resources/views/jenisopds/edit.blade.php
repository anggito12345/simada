@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Jenisopd
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($jenisopd, ['route' => ['jenisopds.update', $jenisopd->id], 'method' => 'patch']) !!}

                        @include('jenisopds.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection