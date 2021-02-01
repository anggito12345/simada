@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventaris Penyusutan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inventarisPenyusutan, ['route' => ['inventarisPenyusutans.update', $inventarisPenyusutan->id], 'method' => 'patch']) !!}

                        @include('inventaris_penyusutans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection