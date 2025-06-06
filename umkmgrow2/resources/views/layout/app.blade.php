<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UMKMGrow</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
    @vite('resources/js/app.js')   {{-- Jika pakai JS --}}
</head>
<body class="bg-primary min-h-screen font-sans">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Konten utama --}}
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

</body>
</html>