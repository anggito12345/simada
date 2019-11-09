@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Ubah Password</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary w-50">
            <div class="box-body">
            {!! Form::model($users, ['route' => ['users.update', $users->id], 'method' => 'patch']) !!}  
                {!! Form::hidden('from_ubah_password', true, ['class' => 'form-control']) !!}            

                <div class="form-group col-md-12">
                    {!! Form::label('password', 'Password Baru:') !!} <span class='text text-danger'>*</span>
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-md-12">
                    {!! Form::label('password_confirmation', 'Konfirmasi Password Baru:') !!} <span class='text text-danger'>*</span>
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group <?=  isset($isFromRegister) ? 'col-md-12' : 'col-md-6' ?> col-sm-12">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

