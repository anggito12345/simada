@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Mutasi Detil
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($mutasiDetil, ['route' => ['mutasiDetils.update', $mutasiDetil->id], 'method' => 'patch']) !!}

                        @include('mutasi_detils.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection