@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Barang
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
                    {!! Form::open(['route' => 'barangs.store']) !!}

                        @include('barangs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <?php 
            $idPostfix = rand(1, 1000000)."ajax";
        ?>
        @include('barangs.modal')
    </div>
@endsection
