@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pemanfaatan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pemanfaatan, ['route' => ['pemanfaatans.update', $pemanfaatan->id], 'method' => 'patch']) !!}

                        @include('pemanfaatans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection