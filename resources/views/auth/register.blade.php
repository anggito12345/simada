<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMADA</title>

     <!-- Tell the browser to be responsive to screen width -->
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/bootstrap.min.css') ?>">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/font-awesome.min.css') ?>">

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/ionicons.min.css') ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= url('css/thirdparty/_all-skins.min.css') ?>">

    <link rel="stylesheet" href="<?= url('css/thirdparty/select2.min.css') ?>">

    <link rel="stylesheet" href="<?= url('css/thirdparty/select2-bootstrap.min.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .register-box-body {
            width: 450px;
        }

        .login-box, .register-box {
            width: 460px;
            /* margin: 7% auto; */
        }
    </style>
    @include('layouts.css')
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/home') }}"><b>SIMADA</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Daftar</p>

        @include('adminlte-templates::common.errors')

        {!! Form::open(['route' => 'auth.register']) !!}

            {!! csrf_field() !!}

            <!-- Name Field -->
            <div class="form-group col-md-12">
                {!! Form::label('nip', 'NIP:') !!} <span class='text text-danger'>*</span>
                {!! Form::text('nip', null, ['class' => 'form-control', 'maxlength' => '18', 'minlength' => '18']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('name', 'Nama:') !!} <span class='text text-danger'>*</span>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Email Field -->
            <div class="form-group col-md-12">
                {!! Form::label('email', 'Email:') !!} <span class='text text-danger'>*</span>
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('no_hp', 'HP:') !!} <span class='text text-danger'>*</span>
                {!! Form::text('no_hp', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('tgl_lahir', 'Tanggal Lahir:') !!} <span class='text text-danger'>*</span>
                {!! Form::text('tgl_lahir', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-md-12 ">
                {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}&nbsp;
                <br />
                <div class="radio">
                    {!! Form::radio('jenis_kelamin', 'L', true, []) !!} Laki - Laki <br />
                    {!! Form::radio('jenis_kelamin', 'P', false, []) !!} Perempuan
                </div>
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('pid_organisasi', 'Organisasi:') !!} <span class='text text-danger'>*</span>
                {!! Form::select('pid_organisasi', [], null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group col-md-12">
                {!! Form::label('username', 'Username:') !!} <span class='text text-danger'>*</span>
                {!! Form::text('username', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Password Field -->
            <div class="form-group col-md-12">
                {!! Form::label('password', 'Password:') !!} <span class='text text-danger'>*</span>
                {!! Form::password('password', ['class' => 'form-control', 'readonly' => 'true', 'onfocus' => 'this.removeAttribute("readonly");this.blur();    this.focus();']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('password_confirmation', 'Konfirmasi Password:') !!} <span class='text text-danger'>*</span>
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'readonly' => 'true', 'onfocus' => 'this.removeAttribute("readonly");this.blur();    this.focus();']) !!}
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        {!! Form::close() !!}

    </div>
    <!-- /.form-box -->
</div>
<!-- /.login-box -->

<script src="<?= url('js/thirdparty/jquery.min.js') ?>"></script>

<script src="<?= url('js/thirdparty/moment.min.js') ?>"></script>
<script src="<?= url('js/thirdparty/select2.min.js') ?>"></script>

<script src="<?= url('js/plugins/inlinedatepicker.plugin.js?key='.sha1(time())) ?>"></script>
<script src="<?= url('js/thirdparty/bootstrap.min.js') ?>"></script>

<!-- AdminLTE App -->
<script src="<?= url('js/thirdparty/adminlte.min.js') ?>"></script>
@include('users.script')
</body>
</html>
