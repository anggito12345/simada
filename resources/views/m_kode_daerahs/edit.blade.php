@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            M Kode Daerah
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="">
                   {!! Form::model($mKodeDaerah, ['route' => ['mKodeDaerahs.update', $mKodeDaerah->id], 'method' => 'patch']) !!}

                        @include('m_kode_daerahs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
