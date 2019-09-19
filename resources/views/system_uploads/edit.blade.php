@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            System Upload
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($systemUpload, ['route' => ['systemUploads.update', $systemUpload->id], 'method' => 'patch']) !!}

                        @include('system_uploads.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection