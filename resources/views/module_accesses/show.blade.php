@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Module Access
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('module_accesses.show_fields')
                    <a href="{!! route('moduleAccesses.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
