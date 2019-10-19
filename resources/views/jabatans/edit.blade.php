@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Jabatan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($jabatan, ['route' => ['jabatans.update', $jabatan->id], 'method' => 'patch']) !!}

                        @include('jabatans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection