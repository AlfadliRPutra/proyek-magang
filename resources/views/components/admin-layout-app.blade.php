<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $title ?? 'IMPACT' }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />


    <!-- Fonts and icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}" />

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <x-admin-layout-sidebar></x-admin-layout-sidebar>
        <!-- End Sidebar -->

        <div class="main-panel">
            {{-- Navbar --}}
            <x-admin-layout-navbar></x-admin-layout-navbar>
            {{-- end navbar --}}
            <div class="container">

                {{ $slot }}

            </div>

            {{-- footer --}}
            <x-admin-layout-footer></x-admin-layout-footer>
            {{-- end footer --}}

        </div>


    </div>
    <x-admin-layout-script></x-admin-layout-script>
</body>

</html>
