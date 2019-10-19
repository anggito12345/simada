@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Mitra
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container container-view">
                    @include('mitras.show_fields')
                    
                </div>
                <a href="{!! route('mitras.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@endsection
