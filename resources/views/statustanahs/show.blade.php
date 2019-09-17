@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Statustanah
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container container-view" style="padding-left: 20px">
                    @include('statustanahs.show_fields')
                    
                </div>
                <a href="{!! route('statustanahs.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@endsection
