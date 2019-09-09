@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Statustanah
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="">
                    {!! Form::open(['route' => 'statustanahs.store']) !!}

                        @include('statustanahs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
