<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aset Jabar</title>

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

    <style>
        @font-face {
            font-family: mainfont;
            src: url(<?= url('css/fonts/SourceSansPro-Regular.otf') ?>);
        }

        body {
            font-family: mainfont !important;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/home') }}"><b>Aset </b>Jabar</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="post" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            @if(isset($_GET['verificationCallback']))
                <div class='alert alert-<?= $_GET['verificationCallback'] == '1' ? 'success' : 'error' ?>'>
                    <?= $_GET['verificationCallback'] == '1' ? 'User telah berhasil diaktivasi' : 'Link telah expired' ?>
                </div>
            @endif

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="username" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

            </div>
            <div class="row">                
                <!-- /.col -->
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>                    
                </div>
                <!-- /.col -->
            </div>
            <div class="row pt-1">                
                <!-- /.col -->
                <div class="col-md-12">
                    <button type="button" onclick="window.location='<?= url('') ?>/register'" class="btn btn-primary btn-block btn-flat">Register</button>                    
                </div>
                <!-- /.col -->
            </div>
        </form>

        <br />

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="<?= url('js/thirdparty/jquery.min.js') ?>"></script>
<script src="<?= url('js/thirdparty/bootstrap.min.js') ?>"></script>

<!-- AdminLTE App -->
<script src="<?= url('js/thirdparty/adminlte.min.js') ?>"></script>
</body>
</html>
