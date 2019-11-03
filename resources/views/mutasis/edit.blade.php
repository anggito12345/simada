@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Mutasi
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($mutasi, ['route' => ['mutasis.update', $mutasi->id], 'method' => 'patch', 'id' => 'form-mutasi']) !!}

                        @include('mutasis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection