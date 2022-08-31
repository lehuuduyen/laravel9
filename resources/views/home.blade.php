<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/sweetalert2.min.css') }}">
    
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .file-upload {
            background-color: #ffffff;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .file-upload-btn {
            width: 100%;
            margin: 0;
            color: #fff;
            background: #1FB264;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #15824B;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .file-upload-btn:hover {
            background: #1AA059;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #1FB264;
            position: relative;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #1FB264;
            border: 4px dashed #ffffff;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            text-transform: uppercase;
            color: #15824B;
            padding: 60px 0;
        }

        .file-upload-image {
            max-height: 200px;
            max-width: 200px;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 200px;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }

        table {
            width: 100% !important
        }
        .brand-link{
            padding: 0px !important
        }
        label abbr {
    color: red;
}
    </style>
    @yield('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <input type="hidden" name="slugLanguage" id="slugLanguage" value="{{ $slugLanguage }}">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('/adminlte/dist/img/icdLogo.png') }}" alt="AdminLTELogo"
                height="120" width="180">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light navbar-white">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                {{ __('message.welcome') }}


                <li class="nav-item">
                    <a href="{!! route('user.change-language', ['en']) !!}">English</a>
                    <a href="{!! route('user.change-language', ['jp']) !!}">Japan</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-dark-primary">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link text-black navbar-light">
                <img src="{{ asset('/adminlte/dist/img/icdLogo.png') }}" alt="ICD Logo"
                    style="opacity: .8;margin-left:18px">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item ">
                            <a href="/dashboard" class="nav-link {{ $active == 'dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php 
                        foreach($page as $value){
                          ?>
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ isset($activeUL) && $activeUL == $value->slug ? 'active' : '' }}">
                                <i class="nav-icon fa fa-edit"></i>

                                <p>
                                    {{ $value->title }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item ">
                                    <a href="/post?post_type={{ $value->slug }}"
                                        class="nav-link {{ ($active == $value->slug && $postActive == "index") ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            {{ __('message.list', ['title' => $value->title]) }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="/post/create?post_type={{ $value->slug }}"
                                        class="nav-link {{ ($active == $value->slug && $postActive == "create") ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Add new
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="/category?post_type={{ $value->slug }}"
                                        class="nav-link {{ $active == 'category' . $value->slug ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Category
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                            }
                        ?>
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ $active == 'page' || $active == 'config' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Setting
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/config" class="nav-link {{ $active == 'config' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Config field</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/page" class="nav-link {{ $active == 'page' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Page</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        {{-- <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Page Top
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                About Company
              </p>
            </a>
          </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('content-title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('content-title')</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('/adminlte/plugins/sparklines/sparkline.js') }}"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('/adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('/adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/adminlte/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/adminlte/dist/js/demo.js') }}"></script>
    <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <script src="{{ asset('/js/filemanager.js') }}"></script>
    <script src="{{ asset('/js/custom.min.js') }}"></script>
    <script type="text/javascript">
        /**
         * JUZAWEB CMS - THE BEST CMS FOR LARAVEL PROJECT
         *
         * @package    juzaweb/juzacms
         * @link       https://juzaweb.com/cms
         * @license    GNU V2
         */
        var juzaweb = {
            adminPrefix: "{{ $admin_prefix }}",
            adminUrl: "{{ url($admin_prefix) }} ",
            lang: @json($slugLanguage)
        }
    </script>
    
    <script>
        const slugLanguage = $("#slugLanguage").val()

        function BtnLoading(elem) {
            $(elem).attr("data-original-text", $(elem).html());
            $(elem).prop("disabled", true);
            $(elem).html('<i class="spinner-border spinner-border-sm"></i> Loading...');
        }

        function BtnReset(elem) {
            $(elem).prop("disabled", false);
            $(elem).html($(elem).attr("data-original-text"));
        }
      
        function alertError(message = "") {

            Swal.fire({
                icon: 'error',
                title: 'Ops...Error',
                html: message,
                // timer: 3000,
                timerProgressBar: true
            })
        }

        function alertSuccess(message = "Saved!!!!",redirect ="") {
            Swal.fire({
                icon: 'success',
                title: 'success',
                html: message,
                // timer: 3000,
                timerProgressBar: true
            })
            if(redirect){
                location.href=redirect
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('javascript')
</body>

</html>
