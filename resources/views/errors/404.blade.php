<html>
<head>
    @include('global.global')
    <title>404 Not Found | {{ config('app.brand') }}</title>
    @yield('links')
</head>

<body>
    @yield('header')

    <div class="error-section">
        <div class="center">
            <p class="error-code">404</p>
            <p class="error-code-sub">Page Not found</p>
        </div>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>