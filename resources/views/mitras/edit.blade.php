@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Mitra
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($mitra, ['route' => ['mitras.update', $mitra->id], 'method' => 'patch']) !!}

                        @include('mitras.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection