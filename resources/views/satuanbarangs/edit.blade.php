@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Satuanbarang
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($satuanbarang, ['route' => ['satuanbarangs.update', $satuanbarang->id], 'method' => 'patch']) !!}

                        @include('satuanbarangs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection