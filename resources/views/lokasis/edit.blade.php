@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Lokasi
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($lokasi, ['route' => ['lokasis.update', $lokasi->id], 'method' => 'patch']) !!}

                        @include('lokasis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection