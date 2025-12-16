
<head>
    <title>FastService - Admin Panel</title>
    <meta charset="utf-8" />
    <meta name="description" content="FastService Admin Panel - Otel hizmet yönetim sistemi" />
    <meta name="keywords" content="fastservice, otel, hizmet yönetimi, admin panel" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:locale" content="tr_TR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="FastService - Admin Panel" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:site_name" content="FastService" />
    <link rel="canonical" href="{{ url('/') }}" />
    <link rel="shortcut icon" href="{{ asset('site/assets/img/logo.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Font Awesome Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--end::Font Awesome Icons-->
    <!--begin::Preload CSS-->
    <link rel="preload" href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" as="style" />
    <link rel="preload" href="{{ asset('admin/assets/css/style.bundle.css') }}" as="style" />
    <!--end::Preload CSS-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->

    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
    
    <!--begin::Custom Logo Styles-->
    <style>
        .app-sidebar-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 60px;
        }
        
        .app-sidebar-logo a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        
        .app-sidebar-logo img {
            height: 60px !important;
            width: auto;
            object-fit: contain;
        }
        
        /* Mobile logo */
        .d-flex.align-items-center.flex-grow-1.flex-lg-grow-0 a {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .d-flex.align-items-center.flex-grow-1.flex-lg-grow-0 img {
            height: 60px !important;
            width: auto;
            object-fit: contain;
        }
    </style>
    <!--end::Custom Logo Styles-->
</head>