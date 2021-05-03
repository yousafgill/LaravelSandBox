<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!--BEGIN: Global Stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="/theme/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/global_assets/css/icons/material/styles.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/layout.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/components.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/colors.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/custom.css" rel="stylesheet" type="text/css">
        <link href="/theme/global_assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
        <!--END: Global Stylesheets -->

        <!--BEGIN: Alpine JS -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

        <!--END: Alpine JS -->

        <!--BEGIN: Core js Files -->
        <script src="/theme/global_assets/js/main/jquery.min.js"></script>
        <script src="/theme/global_assets/js/main/bootstrap.bundle.min.js"></script>
        <script src="/theme/global_assets/js/plugins/loaders/blockui.min.js"></script>
        <!--END: Core js Files -->


        <!-- BEGIN: Theme js Files -->
        <script src="/theme/global_assets/js/plugins/styling/uniform.min.js"></script>
        <script src="/theme/global_assets/js/plugins/styling/switchery.min.js"></script>
        <script src="/theme/global_assets/js/plugins/styling/switch.min.js"></script>
        <script src="/theme/global_assets/js/plugins/ui/moment/moment.min.js"></script>
        <script src="/theme/global_assets/js/plugins/pickers/daterangepicker.js"></script>

        <script src="/theme/assets/js/app.js"></script>
        <script src="/theme/assets/js/custom.js"></script>
        <script src="/theme/global_assets/js/demo_pages/picker_date.js"></script>
        <script src="/theme/global_assets/js/demo_pages/animations_css3.js"></script>

        <!--END: Theme js Files -->
        @livewireStyles
    </head>

    <body>
        <!-- Main Navbar -->
        @livewire('roadmap-topnav-partial')
        @livewire('roadmap-secondnav-partial')
        <!-- /Main Navbar -->

        <!-- Page Content -->
        <div class="page-content">
            <!-- Main Sidebar -->
            <!-- livewire('mainsidebarpartial') -->
            <!-- livewire('postsidebarpartial') -->
            <!-- /Main Sidebar -->

            <!-- Main Content -->
            <div class="content-wrapper">
                <!-- Page Header -->

                <!-- livewire('pageheaderpartial') -->
                <!-- /Page Header -->

                <!-- Content Area -->
                <div class="content layout-boxed" style="box-shadow:none;">
                    <!-- @yield('content') -->
                    {{ $slot }}
                </div>
                <!-- /Content Area -->


                <!-- Footer -->
                @livewire('footerpartial')
                <!-- /Footer -->

            </div>
            <!-- /Main Content -->

            <!-- Modal -->

            <div id="modal-tabbed" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                        <!-- Form -->

                        <ul class="nav nav-tabs nav-justified alpha-grey mb-0">
                            <li class="nav-item"><a href="#login-tab1" class="nav-link border-y-0 border-left-0" data-toggle="tab">
                                    <h6 class="my-1">Sign in</h6>
                                </a></li>
                            <li class="nav-item"><a href="#login-tab2" class="nav-link border-y-0 border-right-0 active" data-toggle="tab">
                                    <h6 class="my-1">Register</h6>
                                </a></li>
                        </ul>

                        <div class="tab-content modal-body">
                            <!--Login -->

                            <div class="tab-pane fade" id="login-tab1">
                                <div class="text-center mb-3">
                                    <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                    <h5 class="mb-0">Login to your account</h5>
                                    <span class="d-block text-muted">Your credentials</span>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                        <div class="form-control-feedback">
                                            <i class="icon-mention text-muted"></i>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                        <div class="form-control-feedback">
                                            <i class="icon-lock2 text-muted"></i>
                                        </div>
                                    </div>

                                    <div class="form-group d-flex align-items-center">
                                        <a href="{{url('/forgot-password')}}" class="ml-auto">Forgot password?</a>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>

                            </div>
                            <!--/Login -->

                            <!--Register -->
                            <div class="tab-pane fade show active" id="login-tab2">
                                <div class="text-center mb-3">
                                    <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                    <h5 class="mb-0">Create account</h5>
                                    <span class="d-block text-muted">All fields are required</span>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                        <div class="form-control-feedback">
                                            <i class="icon-mention text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                        <div class="form-control-feedback">
                                            <i class="icon-mention text-muted"></i>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Your password">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-lock text-muted"></i>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-lock text-muted"></i>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn bg-dark btn-block">Register</button>
                                    <span class="form-text text-center text-muted">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
                                </form>
                                <div class="form-group text-center text-muted content-divider">
                                    <span class="px-2">Already have an account?</span>
                                </div>
                                <!-- <div class="form-group"> -->
                                <a href="#login-tab1" class="btn btn-light btn-block" data-toggle="tab">Sign in</a>
                                <!-- </div> -->
                            </div>

                            <!--/Register -->
                        </div>

                        <!-- /form -->

                    </div>
                </div>
            </div>

            <!-- End Modal -->


        </div>
        <!-- /Page Content -->
        @livewireScripts
    </body>

</html>