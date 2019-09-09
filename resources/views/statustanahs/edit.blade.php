@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Statustanah
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($statustanah, ['route' => ['statustanahs.update', $statustanah->id], 'method' => 'patch']) !!}

                        @include('statustanahs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection