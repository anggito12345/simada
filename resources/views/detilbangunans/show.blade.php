@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detilbangunan
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container container-view" style="padding-left: 20px">
                    @include('detilbangunans.show_fields')
                    
                </div>
                
            </div>
        </div>            
        <a href="{!! route('detilbangunans.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
