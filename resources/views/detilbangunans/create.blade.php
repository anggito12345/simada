@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detilbangunan
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
                    {!! Form::open(['route' => 'detilbangunans.store']) !!}

                        @include('detilbangunans.fields')

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
