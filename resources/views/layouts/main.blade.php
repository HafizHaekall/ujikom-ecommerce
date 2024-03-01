<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | E-COMMERCE</title>

    {{-- feather icons --}}
    <script src="https://unpkg.com/feather-icons"></script>

    @yield('head')
    @vite(['resources/js/app.js'])
</head>
<body>
  @unless(request()->is('login') || request()->is('register'))
    @include('partials.navbar')

    <div class="p-4 lg:py-8 lg:px-12">
      @yield('container')
    </div>
  @endunless

    {{-- feather icons --}}
    <script>
      feather.replace();
    </script>
</body>
</html>