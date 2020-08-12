<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
            type="text/css">
        <link href="https://cdn.yousafgill.com/limitless2_3/global_assets/css/icons/icomoon/styles.min.css"
            rel="stylesheet" type="text/css">

        <link href="https://cdn.yousafgill.com/limitless2_3/templates/layout_1/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.yousafgill.com/limitless2_3/templates/layout_1/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.yousafgill.com/limitless2_3/templates/layout_1/assets/css/layout.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.yousafgill.com/limitless2_3/templates/layout_1/assets/css/components.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.yousafgill.com/limitless2_3/templates/layout_1/assets/css/colors.min.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script src="https://cdn.yousafgill.com/limitless2_3/global_assets/js/main/jquery.min.js"></script>
        <script src="https://cdn.yousafgill.com/limitless2_3/global_assets/js/main/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.yousafgill.com/limitless2_3/global_assets/js/plugins/loaders/blockui.min.js"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script src="https://cdn.yousafgill.com/limitless2_3/templates/layout_1/assets/js/layout_1_app.js"></script>
        <!-- /theme JS files -->

    </head>

    <body class="navbar-top">

        <!-- Main navbar -->
        <div class="navbar navbar-expand-md navbar-dark fixed-top">
            <div class="navbar-brand">
                <a href="{{ url('/') }}" class="d-inline-block">
                    <!-- <img src="https://cdn.yousafgill.com/limitless2_3/global_assets/images/logo_light.png" alt=""> -->
                     {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="d-md-none">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                    <i class="icon-tree5"></i>
                </button>
                <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                    <i class="icon-paragraph-justify3"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                            <i class="icon-paragraph-justify3"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#" class="navbar-nav-link">
                            Text link
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="navbar-nav-link">
                            <i class="icon-bell2"></i>
                            <span class="d-md-none ml-2">Notifications</span>
                            <span class="badge badge-mark border-white ml-auto ml-md-0"></span>
                        </a>
                    </li>

                    <li class="nav-item dropdown dropdown-user">
                        <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle"
                            data-toggle="dropdown">
                            <img src="https://cdn.yousafgill.com/limitless2_3/global_assets/images/image.png"
                                class="rounded-circle mr-2" height="34" alt="">
                            <span>Victoria</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                            <a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>
                            <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span
                                    class="badge badge-pill bg-blue ml-auto">58</span></a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                            <a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navbar -->


        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

                <!-- Sidebar mobile toggler -->
                <div class="sidebar-mobile-toggler text-center">
                    <a href="#" class="sidebar-mobile-main-toggle">
                        <i class="icon-arrow-left8"></i>
                    </a>
                    Navigation
                    <a href="#" class="sidebar-mobile-expand">
                        <i class="icon-screen-full"></i>
                        <i class="icon-screen-normal"></i>
                    </a>
                </div>
                <!-- /sidebar mobile toggler -->


                <!-- Sidebar content -->
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user">
                        <div class="card-body">
                            <div class="media">
                                <div class="mr-3">
                                    <a href="#"><img
                                            src="https://cdn.yousafgill.com/limitless2_3/global_assets/images/image.png"
                                            width="38" height="38" class="rounded-circle" alt=""></a>
                                </div>

                                <div class="media-body">
                                    <div class="media-title font-weight-semibold">Victoria Baker</div>
                                    <div class="font-size-xs opacity-50">
                                        <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
                                    </div>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /user menu -->


                    <!-- Main navigation -->
                    <div class="card card-sidebar-mobile">
                        <ul class="nav nav-sidebar" data-nav-type="accordion">

                            <!-- Main -->
                            <li class="nav-item-header">
                                <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu"
                                    title="Main"></i>
                            </li>
                            <li class="nav-item">
                                <a href="../full/index.html" class="nav-link">
                                    <i class="icon-home4"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
                                <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Starter kit</span></a>

                                <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                    <li class="nav-item"><a href="../seed/layout_nav_horizontal.html"
                                            class="nav-link">Horizontal navigation</a></li>
                                    <li class="nav-item"><a href="../seed/sidebar_none.html" class="nav-link">No
                                            sidebar</a></li>
                                    <li class="nav-item"><a href="../seed/sidebar_main.html" class="nav-link">1
                                            sidebar</a></li>
                                    <li class="nav-item nav-item-submenu">
                                        <a href="#" class="nav-link">2 sidebars</a>
                                        <ul class="nav nav-group-sub">
                                            <li class="nav-item"><a href="../seed/sidebar_secondary.html"
                                                    class="nav-link">Secondary sidebar</a></li>
                                            <li class="nav-item"><a href="../seed/sidebar_right.html"
                                                    class="nav-link">Right sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item nav-item-submenu">
                                        <a href="#" class="nav-link">3 sidebars</a>
                                        <ul class="nav nav-group-sub">
                                            <li class="nav-item"><a href="../seed/sidebar_right_hidden.html"
                                                    class="nav-link">Right sidebar hidden</a></li>
                                            <li class="nav-item"><a href="../seed/sidebar_right_visible.html"
                                                    class="nav-link">Right sidebar visible</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item nav-item-submenu">
                                        <a href="#" class="nav-link">Content sidebars</a>
                                        <ul class="nav nav-group-sub">
                                            <li class="nav-item"><a href="../seed/sidebar_content_left.html"
                                                    class="nav-link">Left sidebar</a></li>
                                            <li class="nav-item"><a href="../seed/sidebar_content_right.html"
                                                    class="nav-link">Right sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item"><a href="../seed/layout_boxed.html" class="nav-link">Boxed
                                            layout</a></li>
                                    <li class="nav-item-divider"></li>
                                    <li class="nav-item"><a href="../seed/navbar_fixed_main.html"
                                            class="nav-link active">Fixed main navbar</a></li>
                                    <li class="nav-item"><a href="../seed/navbar_fixed_secondary.html"
                                            class="nav-link">Fixed secondary navbar</a></li>
                                    <li class="nav-item"><a href="../seed/navbar_fixed_both.html" class="nav-link">Both
                                            navbars fixed</a></li>
                                    <li class="nav-item"><a href="../seed/layout_fixed.html" class="nav-link">Fixed
                                            layout</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="../full/changelog.html" class="nav-link">
                                    <i class="icon-list-unordered"></i>
                                    <span>Changelog</span>
                                    <span class="badge bg-blue-400 align-self-center ml-auto">2.3</span>
                                </a>
                            </li>
                            <!-- /main -->

                        </ul>
                    </div>
                    <!-- /main navigation -->

                </div>
                <!-- /sidebar content -->

            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                @yield('content')

                <!-- Footer -->
                <div class="navbar navbar-expand-lg navbar-light">
                    <div class="text-center d-lg-none w-100">
                        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                            data-target="#navbar-footer">
                            <i class="icon-unfold mr-2"></i>
                            Footer
                        </button>
                    </div>

                    <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text">
                            &copy; 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a
                                href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                        </span>

                        <ul class="navbar-nav ml-lg-auto">
                            <li class="nav-item">
                                <a href="#" class="navbar-nav-link">Text link</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="navbar-nav-link">
                                    <i class="icon-lifebuoy"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov"
                                    class="navbar-nav-link font-weight-semibold">
                                    <span class="text-pink-400">
                                        <i class="icon-cart2 mr-2"></i>
                                        Purchase
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /footer -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </body>

</html>