@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventaris
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container container-view" >
                    @include('inventaris.show_fields')
                   
                </div>
                <a href="{!! route('inventaris.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@endsection
