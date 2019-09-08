@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Merkbarang
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($merkbarang, ['route' => ['merkbarangs.update', $merkbarang->id], 'method' => 'patch']) !!}

                        @include('merkbarangs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection