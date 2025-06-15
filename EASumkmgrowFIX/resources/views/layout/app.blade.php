<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UMKMGrow</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
    @vite('resources/js/app.js')   {{-- Jika pakai JS --}}
</head>
<body class="flex flex-col min-h-screen">

  @include('components.navbar')

  <main class="flex-grow">
    @yield('content')
  </main>

  @include('components.footer')

</body>

</html>