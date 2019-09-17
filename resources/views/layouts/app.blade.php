<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SIMADA</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <style>
        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url('<?= url('css/fonts/glyphicons-halflings-regular.eot') ?>');
            src: url('<?= url('css/fonts/glyphicons-halflings-regular.eot') ?>') format('embedded-opentype'),  url('<?= url('css/fonts/glyphicons-halflings-regular.woff') ?>') format('woff'), url('<?= url('css/fonts/glyphicons-halflings-regular.ttf') ?>') format('truetype'), url('<?= url('css/fonts/glyphicons-halflings-regular.svg') ?>') format('svg');
        }
    </style>

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

    <link rel="stylesheet" href="<?= url('css/thirdparty/select2-bootstrap.min.css') ?>">

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= url('css/thirdparty/ionicons2.min.css') ?>">

    <link rel="stylesheet" href="<?= url('css/thirdparty/sweetalert2.min.css') ?>">

    <link rel="stylesheet" href="<?= url('css/thirdparty/responsive.dataTables.min.css') ?>">
   
    @include('layouts.datatables_css')

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

        .dataTables_wrapper .row {
            width: 100% !important;
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

        .select2-selection__rendered {
            line-height: 2;
        }

        .select2-container--bootstrap {
            width: 100% !important;
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

        .paginate_button.active a{
            color: rgba(255,255,255,.5);
        }

        @font-face {
            font-family: mainfont;
            src: url(<?= url('css/fonts/SourceSansPro-Regular.otf') ?>);
        }

        body {
            font-family: mainfont !important;
        }

        .collapse-toggle {
            width: 100%;
        }

        .box-header .collapse-toggle:after {
            /* symbol for "opening" panels */
            font-family: FontAwesome;  /* essential for enabling glyphicon */
            content: "\f062";    /* adjust as needed, taken from bootstrap.css */
            float: right;        /* adjust as needed */
            color: white;         /* adjust as needed */
        }

        .box-header .collapse-toggle.collapsed:after {
            /* symbol for "collapsed" panels */
            content: "\f063";    /* adjust as needed, taken from bootstrap.css */
        }

        .width-60 {
            width: 60% !important;
            float: left;
        }

        .width-80 {
            width: 80% !important;
            float: left;
        }

        .lookup-100 {
            width: 100%;
        }

        table.dataTable {
            width:100% !important;
        }

        .modal-lookup .dataTables_length {
        }

        .modal-lookup .row {
            width: 100%;
            margin: 0;
        }

        .fade-scale {
            transform: scale(0);
            opacity: 0;
            -webkit-transition: all 1s linear;
            -o-transition: all 1s linear;
            transition: all 1s linear;
        }

        .fade-scale.show {
            opacity: 1;
            transform: scale(1);
        }
    </style>
</head>

<input type="text" value="<?= url('') ?>" base-path style="display:none" />

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
    <script src="<?= url('js/thirdparty/jquery.mask.min.js') ?>"></script>

    @include('layouts.datatables_js')    
    <script src="<?= url('js/public.js?key='.sha1(time())) ?>"></script>

    <script src="<?= url('js/thirdparty/moment.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/bootstrap.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/bootstrap-toggle.min.js') ?>"></script>
    
    <!-- AdminLTE App -->
    <script src="<?= url('js/thirdparty/bootstrap-toggle.min.js') ?>"></script>
    <script src="<?= url('js/thirdparty/adminlte.min.js') ?>"></script>

    <script src="<?= url('js/thirdparty/select2.min.js') ?>"></script>

    <script src="<?= url('js/thirdparty/sweetalert2.min.js') ?>"></script>

    
    <script>

        $.fn.datepicker.defaults.language = 'in'
        $.fn.datepicker.defaults.autClose = true
        $.fn.datepicker.dates['in'] = {
            days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"],
            daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
            daysMin: ["Mg", "Sn", "Su", "Sl", "Rb", "Km", "Sb"],
            months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            today: "Hari Ini",
            clear: "Clear",
            format: "dd-mm-yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
        };


        $(function() {
            $('input').attr('autocomplete','off');
            $('input').attr('autocorrect','off');
            $('form').attr('autocomplete','off');

            $('input[type=number]').keyup((obj) => {
                let valueNumber = parseInt(obj.target.value)
                const maxAttribute = obj.target.getAttribute('max')
                if (maxAttribute != undefined) {
                    if (valueNumber > parseInt(maxAttribute)) {
                        obj.target.value = parseInt(maxAttribute)
                    }
                }
            });  
            
            var elements = document.querySelectorAll("input,select");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        if (e.target.getAttribute('required') != null && (e.target.value == '' || e.target.value == null)) {
                            e.target.setCustomValidity("Data wajib di isi!");
                        }
                        
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }
        })


    </script>
    @yield('scripts')
    @yield('scripts_2')

</body>
</html>
