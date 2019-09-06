<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SIMADA</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= url('css/thirdparty/bootstrap-datepicker.min.css') ?>">
    <link rel="stylesheet" href="<?= url('css/thirdparty/bootstrap-datepicker3.min.css') ?>">
    <link rel="stylesheet" href="<?= url('css/thirdparty/bootstrap-toggle.min.css') ?>">

    <!-- Font Awesome -->    
    <link rel="stylesheet" href="<?= url('css/thirdparty/font-awesome.min.css') ?>">

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/ionicons.min.css') ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= url('css/thirdparty/_all-skins.min.css') ?>">


    <link rel="stylesheet" href="<?= url('css/thirdparty/select2.min.css') ?>">

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/ionicons2.min.css') ?>">

    <script src="<?= url('js/public.js') ?>"></script>

    @yield('css')

    <style>
        .navbar {
            padding: 0px;
        }

        .pagination {
            margin: 10px !important;
        }

        .pagination>li>a {
            background: #35b4d4;
            padding: 10px;
            margin: 1px;
            color: white;
            cursor: pointer;
        }

        .pagination>li.disabled>a {
            cursor: not-allowed;
            color: rgba(255,255,255,.5);
        }

        .dataTables_filter {
            margin-left: 10px;
        }

        li.user-menu {
            margin-right: 1em;
        }

        span.select2-selection {
            border-color: #d2d6de !important;
            padding: .375rem .75rem !important;
            border-radius: none !important;
            height: 37.73px !important;
        }

        .select2-container--default .select2-selection--single {
            border-radius: 0px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 5px;
        }


        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2rem;
        }

        .container-view {
            margin-bottom: 20px;
        }        

        .container-view .row:nth-child(2n) {
            background:#F3F3F3;
        }

        .container-view .row .item-view {
            margin-bottom:0;
            padding:10px;   
        }

        .container-view .row .item-view:first-child {
            text-align: right;
            font-weight: bold;            
        }

        .image-preview {
            width: 220px;
        }

        @font-face {
            font-family: mainfont;
            src: url(<?= url('css/fonts/SourceSansPro-Regular.otf') ?>);
        }

        body {
            font-family: mainfont !important;
        }
    </style>
</head>

<body class="skin-green-light sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>Simada</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?= url('images/user_male-icon.png') ?>"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?= url('images/user_male-icon.png') ?>""
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        {!! Auth::user()->name !!}
                                        <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2016 <a href="#">Company</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/') !!}">
                    InfyOm Generator
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/home') !!}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/login') !!}">Login</a></li>
                    <li><a href="{!! url('/register') !!}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jQuery 3.1.1 -->
    <script src="<?= url('js/thirdparty/jquery.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/moment.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/bootstrap.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/bootstrap-toggle.min.js') ?>"></script>

    <!-- AdminLTE App -->
    <script src="<?= url('js/thirdparty/bootstrap-toggle.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/adminlte.min.js') ?>"></script>

    <script src="<?= url('js/thirdparty/select2.min.js') ?>"></script>

    

    @yield('scripts')

    <script>
        $(function() {
            $('input').attr('autocomplete','off');
            $('input').attr('autocorrect','off');
            $('form').attr('autocomplete','off');
        })
    </script>
</body>
</html>
