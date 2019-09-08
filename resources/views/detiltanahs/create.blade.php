@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detiltanah
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
                    {!! Form::open(['route' => 'detiltanahs.store', "enctype" => "multipart/form-data"]) !!}

                        @include('detiltanahs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <?php 
        $idPostfix = rand(1, 1000000)."ajax";
    ?>
    @include('inventaris.modal')
@endsection
