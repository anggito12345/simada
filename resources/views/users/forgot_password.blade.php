
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
        @include('flash::message')

        <p class="login-box-msg">Lupa Password</p>

        @include('adminlte-templates::common.errors')

        {!! Form::model($users, ['route' => ['users.update', $users->id], 'method' => 'patch']) !!}
  
            {!! Form::hidden('from_forgot_password', true, ['class' => 'form-control']) !!}           
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



