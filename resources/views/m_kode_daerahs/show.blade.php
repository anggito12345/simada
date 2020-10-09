@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            M Kode Daerah
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('m_kode_daerahs.show_fields')
                    <a href="{{ route('mKodeDaerahs.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
