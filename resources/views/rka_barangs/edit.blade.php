@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Rka Barang
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   <?php
                        $idPostfix = rand(1, 1000000)."non-ajax";
                    ?>
                   {!! Form::model($rkaBarang, ['route' => ['rkaBarangs.update', $rkaBarang->id], 'method' => 'patch']) !!}

                        @include('rka_barangs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
        <?php
            $idPostfix = rand(1, 1000000)."ajax";
        ?>
        @include('rka_barangs.modal')
   </div>
@endsection
