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

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/sweetalert2.min.css') ?>">

    <style>
        @font-face {
            font-family: mainfont;
            src: url(<?= url('css/fonts/SourceSansPro-Regular.otf') ?>);
        }

        body {
            font-family: mainfont !important;


        }

        .left-panel {
            background: url('images/banner-left.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .right-panel {
            min-height: 100vh;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="row">
        <div class="col-md-8 left-panel">
        </div>
        <div class="col-md-4 p-5 bg-white right-panel">
            <div class="login-logo mt-2">
                <a href="{{ url('/home') }}"><b>Aset </b>Jabar</a>
            </div>
            <form method="post" class="mt-2" action="{{ url('/login') }}">
                {!! csrf_field() !!}

                @if(isset($_GET['verificationCallback']))
                <div class='alert alert-<?= $_GET['verificationCallback'] == '1' ? 'success' : 'error' ?>'>
                    <?= $_GET['verificationCallback'] == '1' ? 'User telah berhasil diaktivasi' : 'Link telah expired' ?>
                </div>
                @endif

                @if(isset($_GET['forgotPasswordCallback']))
                <div class='alert alert-<?= $_GET['forgotPasswordCallback'] == '1' ? 'success' : 'error' ?>'>
                    <?= $_GET['forgotPasswordCallback'] == '1' ? 'Password telah berhasi diubah' : 'Password gagal diubah' ?>
                </div>
                @endif

                @if(isset($_GET['successRegister']))
                <div class='alert alert-<?= $_GET['successRegister'] == '1' ? 'success' : 'error' ?>'>
                    <?= $_GET['successRegister'] == '1' ? 'Mohon tunggu persetujuan dari pihak admin' : 'Gagal!' ?>
                </div>
                @endif

                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>Username:</label>
                    <input type="text" class="form-control" name="username" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

                </div>
                <div class="row">
                    <div class="col-md-4">
                        Lupa password ? <a href='#' onclick="$('#modal-lupa-password').modal('show')">Klik disini</a>
                    </div>
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
        </div>
    </div>
    <!-- /.login-box -->

    <div class="modal fade" id="modal-lupa-password" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lupa Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class='col-md-4 form-group'>
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', '', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-send-forgot-email" onclick="sendLupaPassword()">Kirim Email</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= url('js/thirdparty/jquery.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/bootstrap.min.js') ?>"></script>

    <!-- AdminLTE App -->
    <script src="<?= url('js/thirdparty/adminlte.min.js') ?>"></script>

    <script src="<?= url('js/thirdparty/sweetalert2.min.js') ?>"></script>

    <script>
        function sendLupaPassword() {
            $('.btn-send-forgot-email').attr('disabled', 'disabled');

            $.ajax({
                url: '<?= url('api/lupa-password') ?>',
                method: 'POST',
                data: {
                    email: $("#modal-lupa-password input[name=email]").val()
                },
                dataType: 'json',
                complete: () => {
                    $('.btn-send-forgot-email').removeAttr('disabled');
                    $('#modal-lupa-password').modal('hide')
                }
            }).then((d) => {
                swal.fire({
                    type: 'success',
                    text: 'Email lupa password terkirim',
                })
            }, (d) => {
                swal.fire({
                    type: 'error',
                    text: d.message
                })
            })
        }
    </script>
</body>

</html>