@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventaris History
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inventarisHistory, ['route' => ['inventarisHistories.update', $inventarisHistory->id], 'method' => 'patch']) !!}

                        @include('inventaris_histories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection