@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Penghapusan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($penghapusan, ['route' => ['penghapusans.update', $penghapusan->id], 'method' => 'patch', "enctype" => "multipart/form-data"]) !!}

                        @include('penghapusans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection