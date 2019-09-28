@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detilaset
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($detilaset, ['route' => ['detilasets.update', $detilaset->id], 'method' => 'patch']) !!}

                        @include('detilasets.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection