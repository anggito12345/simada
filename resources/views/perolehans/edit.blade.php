@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Perolehan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($perolehan, ['route' => ['perolehans.update', $perolehan->id], 'method' => 'patch']) !!}

                        @include('perolehans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection