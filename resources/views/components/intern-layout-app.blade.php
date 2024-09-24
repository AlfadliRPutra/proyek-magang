<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="theme-color" content="#000000">
    <title>@yield('title')</title>
    <meta name="description" content="Dashboard Presensi">

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">

    <!-- Fonts and Icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Roboto:300,400,500,600,700"]
            },
            custom: {
                families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}" />

    <style>
        body.loader-active {
            overflow: hidden;
            /* Mencegah scrollbar saat loader aktif */
        }

        #loader {
            position: fixed;
            left: 0;
            top: 0;
            z-index: 99999;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 100%;
            min-height: 100%;
            max-width: 100vw;
            max-height: 100vh;
        }

        #loader i {
            font-size: 2.5rem;
            color: red;
            animation: rocket-animation 1s infinite ease-in-out;
        }

        @keyframes rocket-animation {
            0% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-10px) scale(1.1);
            }

            100% {
                transform: translateY(0) scale(1);
            }
        }
    </style>


</head>

<body>

    <!-- Loader -->
    <div id="loader">
        <i class="fas fa-rocket" role="status"></i>
    </div>

    <!-- App Capsule -->
    <div id="appCapsule" class="mb-4">
        {{ $slot }}
    </div>

    <!-- Bottom Navigation Menu -->
    <x-intern-layout-bottom-nabvar></x-intern-layout-bottom-nabvar>

    <!-- Script -->
    <x-intern-layout-script></x-intern-layout-script>



</body>

</html>
