@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Jenisbarang
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($jenisbarang, ['route' => ['jenisbarangs.update', $jenisbarang->id], 'method' => 'patch']) !!}

                        @include('jenisbarangs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection