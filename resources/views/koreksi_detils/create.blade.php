@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Koreksi Detil
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'koreksiDetils.store']) !!}

                        @include('koreksi_detils.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
