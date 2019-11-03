@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Mutasi
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="">
                    {!! Form::open(['route' => 'mutasis.store', 'id' => 'form-mutasi']) !!}

                        @include('mutasis.fields')

                    {!! Form::close() !!}

                    
                </div>
            </div>
        </div>
    </div>
@endsection
