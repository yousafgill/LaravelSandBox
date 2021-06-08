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
        <!--END: Global Stylesheets -->

        <!-- Stripe JS -->
        <script src="https://js.stripe.com/v3/"></script>

        <!-- /Stripe JS -->

        <!--BEGIN: Alpine JS -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

        <!--END: Alpine JS -->

        <!--BEGIN: Core js Files -->
        <script src="/theme/global_assets/js/main/jquery.min.js"></script>
        <script src="/theme/global_assets/js/main/bootstrap.bundle.min.js"></script>
        <script src="/theme/global_assets/js/plugins/loaders/blockui.min.js"></script>
        <!--END: Core js Files -->


        <!-- BEGIN: Theme js Files -->
        <script src="/theme/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="/theme/global_assets/js/plugins/styling/uniform.min.js"></script>
        <script src="/theme/global_assets/js/plugins/styling/switchery.min.js"></script>
        <script src="/theme/global_assets/js/plugins/styling/switch.min.js"></script>
        <script src="/theme/global_assets/js/plugins/ui/moment/moment.min.js"></script>
        <script src="/theme/global_assets/js/plugins/pickers/daterangepicker.js"></script>

        <script src="/theme/assets/js/app.js"></script>
        <script src="/theme/assets/js/custom.js"></script>
        <script src="/theme/global_assets/js/demo_pages/picker_date.js"></script>

        <!--END: Theme js Files -->
        @livewireStyles
    </head>

    <body>
      
        <!-- Page Content -->
        <div class="page-content">
           
            <!-- Main Content -->
            <div class="content-wrapper">

                <!-- Content Area -->
                <div class="content d-flex justify-content-center align-items-center">
                    {{ $slot }}
                </div>
               <!-- /Content Area -->
             </div>
            <!-- /Main Content -->
        </div>
        <!-- /Page Content -->
       
        @livewireScripts

       <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize
            $('.form-input-styled').uniform();
        });

       </script>
    </body>

</html>