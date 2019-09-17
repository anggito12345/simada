@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Kondisi
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($kondisi, ['route' => ['kondisis.update', $kondisi->id], 'method' => 'patch']) !!}

                        @include('kondisis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection