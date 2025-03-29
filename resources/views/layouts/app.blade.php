
<html lang="en"><head>

    <meta charset="utf-8">
    <title>Dashboard | Kadso - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Zoyothemes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">

    <!-- Icons -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">

   </head>

<!-- body start -->
<body data-menu-color="dark" data-sidebar="default" class="menuitem-active">

<!-- Begin page -->
<div id="app-layout" class="show">



    <!-- Left Sidebar Start -->
    <div class="app-sidebar-menu">
        <div class="h-100 menuitem-active" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">

                                <!--- Sidemenu -->
                                <div id="sidebar-menu" class="show">

                                    <div class="logo-box">
                                        <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('images/logo-sm.png') }}" alt="" height="22">
                                </span>
                                            <span class="logo-lg">
                                    <img src="{{ asset('images/logo-light.png') }}" alt="" height="24">
                                </span>
                                        </a>
                                        <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('images/logo-sm.png') }}" alt="" height="22">
                                </span>
                                            <span class="logo-lg">
                                    <img src="{{ asset('images/logo-dark.png') }}" alt="" height="24">
                                </span>
                                        </a>
                                    </div>

                                    <ul id="side-menu">

                                        <li class="menu-title">Menu</li>

                                        <li class="menuitem-active">
                                            <a href="{{ route('users.index') }}" class="active">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>

                                                <span> Пользователи </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('files.index') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-aperture"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
                                                <span> Файлы </span>
                                            </a>
                                        </li>





                                    </ul>

                                </div>
                                <!-- End Sidebar -->

                                <div class="clearfix"></div>

                            </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 665px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 162px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">

                        @yield('content')

            </div> <!-- container-fluid -->
        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col fs-13 text-muted text-center">
                        © <script>document.write(new Date().getFullYear())</script>2025 - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">Zoyothemes</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Vendor -->
<script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('libs/feather-icons/feather.min.js') }}"></script>

<!-- Apexcharts JS -->
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- for basic area chart -->
<script src="https://apexcharts.com/samples/{{ asset('stock-prices.js') }}"></script>

<!-- Widgets Init Js -->
<script src="{{ asset('js/pages/dashboard.init.js') }}"></script>

<svg id="SvgjsSvg1274" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1275"></defs><polyline id="SvgjsPolyline1276" points="0,0"></polyline><path id="SvgjsPath1277" d="M-1 261.79471932106014C-1 261.79471932106014 -1 261.79471932106014 -1 261.79471932106014C-1 261.79471932106014 143.29646472930906 261.79471932106014 143.29646472930906 261.79471932106014C143.29646472930906 261.79471932106014 286.59292945861813 261.79471932106014 286.59292945861813 261.79471932106014C286.59292945861813 261.79471932106014 429.8893941879272 261.79471932106014 429.8893941879272 261.79471932106014C429.8893941879272 261.79471932106014 573.1858589172363 261.79471932106014 573.1858589172363 261.79471932106014C573.1858589172363 261.79471932106014 716.4823236465454 261.79471932106014 716.4823236465454 261.79471932106014 "></path></svg><!-- App js-->
<script src="{{ asset('js/app.js') }}"></script>


</body></html>
