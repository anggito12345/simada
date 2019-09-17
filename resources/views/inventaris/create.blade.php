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
                    {!! Form::open(['route' => 'inventaris.store']) !!}

                        @include('inventaris.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
