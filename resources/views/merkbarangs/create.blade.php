@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Merkbarang
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="">
                    {!! Form::open(['route' => 'merkbarangs.store']) !!}

                        @include('merkbarangs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
