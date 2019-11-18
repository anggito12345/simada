@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Modules
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($modules, ['route' => ['modules.update', $modules->id], 'method' => 'patch']) !!}

                        @include('modules.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection