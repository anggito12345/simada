@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Satuanbarang
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container container-view" style="padding-left: 20px">
                    @include('satuanbarangs.show_fields')
                    
                </div>
                <a href="{!! route('satuanbarangs.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@endsection
