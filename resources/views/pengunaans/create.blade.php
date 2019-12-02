@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pengunaan
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="">
                    {!! Form::open(['route' => 'pengunaans.store']) !!}

                        @include('pengunaans.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
