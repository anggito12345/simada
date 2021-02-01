@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventaris Penyusutan
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container container-view" style="padding-left: 20px">
                    @include('inventaris_penyusutans.show_fields')
                    <a href="{{ route('inventarisPenyusutans.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
