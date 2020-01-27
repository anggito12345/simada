@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Koreksi
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($koreksi, ['route' => ['koreksis.update', $koreksi->id], 'method' => 'patch']) !!}

                        @include('koreksis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection