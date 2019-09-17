@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Perolehan
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container container-view" style="padding-left: 20px">
                    @include('perolehans.show_fields')
                    
                </div>
                <a href="{!! route('perolehans.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@endsection
