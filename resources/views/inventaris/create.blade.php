@extends('layouts.app')

@section('content')
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-header bg-blue">
                Baru
            </div>
            <div class="box-body">
                <div class="">
                    {!! Form::open(['route' => 'inventaris.store', 'id' => 'form-inventaris']) !!}

                        @include('inventaris.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <?php 
            $idPostfix = rand(1, 1000000)."ajax";
        ?>
        @include('inventaris.modal')
    </div>
@endsection
