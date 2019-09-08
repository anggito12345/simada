@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detilmesin
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($detilmesin, ['route' => ['detilmesins.update', $detilmesin->id], 'method' => 'patch']) !!}

                        @include('detilmesins.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection