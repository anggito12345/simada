@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Lokasi
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="">
                    {!! Form::open(['route' => 'lokasis.store']) !!}

                        @include('lokasis.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
