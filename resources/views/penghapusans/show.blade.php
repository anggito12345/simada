@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h3 class="pull-left">{{ Breadcrumbs::render() }}</h3>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="" style="padding-left: 20px">
                    @include('penghapusans.show_fields')
                    <a href="{!! route('penghapusans.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
