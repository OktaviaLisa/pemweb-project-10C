<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Login')</title>
    @vite('resources/css/app.css')
</head>
<body>
    @yield('content')

    {{-- Tambahkan ini --}}
    @stack('scripts')
</body>
</html>