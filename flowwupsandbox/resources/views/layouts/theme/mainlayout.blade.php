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
        <link href="/theme/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/layout.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/components.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/colors.min.css" rel="stylesheet" type="text/css">
        <link href="/theme/assets/css/custom.css" rel="stylesheet" type="text/css">
        <!--END: Global Stylesheets -->


        <!--BEGIN: Core js Files -->
        <script src="/theme/global_assets/js/main/jquery.min.js"></script>
        <script src="/theme/global_assets/js/main/bootstrap.bundle.min.js"></script>
        <script src="/theme/global_assets/js/plugins/loaders/blockui.min.js"></script>
        <script src="/theme/global_assets/js/plugins/styling/uniform.min.js"></script>
        <!-- <script src="/theme/global_assets/js/plugins/styling/switchery.min.js"></script> -->
        <!-- <script src="/theme/global_assets/js/plugins/styling/switch.min.js"></script> -->

        <!--END: Core js Files -->


        <!-- BEGIN: Theme js Files -->
       
        <script src="/theme/assets/js/app.js"></script>
        <!-- <script src="/theme/assets/js/custom.js"></script> -->
        <!-- <script src="/theme/global_assets/js/demo_pages/form_checkboxes_radios.js"></script> -->


        <!--END: Theme js Files -->
    @livewireStyles
    </head>

    <body class>
        <!-- Main Navbar -->
        @livewire('mainnavbarpartial')
        <!-- /Main Navbar -->

        <!-- Page Content -->
        <div class="page-content">
            <!-- Main Sidebar -->
            @livewire('mainsidebarpartial')
            <!-- /Main Sidebar -->

            <!-- Secondary Sidebar -->
            @livewire('secondarysidebarpartial')
            <!-- /Secondary Sidebar -->

            <!-- Main Content -->
            <div class="content-wrapper">
                <!-- Page Header -->
                @livewire('pageheaderpartial')
                <!-- /Page Header -->

                <!-- Content Area -->
                <div class="content">
                   @yield('content')

                </div>
                <!-- /Content Area -->


                <!-- Footer -->
                @livewire('footerpartial')
                <!-- /Footer -->

            </div>
            <!-- /Main Content -->

            <!-- Right Sidebar -->
            @livewire('rightsidebarpartial')
            <!-- / Right Sidebar -->
        </div>
        <!-- /Page Content -->


     
    @livewireScripts
    </body>

</html>