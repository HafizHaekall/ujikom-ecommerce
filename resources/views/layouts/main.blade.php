<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | E-COMMERCE</title>

    {{-- feather icons --}}
    <script src="https://unpkg.com/feather-icons"></script>
    
    {{-- Toastr JS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
        "positionClass": "toast-top-right",
        "closeButton": true,
        "progressBar": true
      };
    </script>

    @yield('head')
    @vite(['resources/js/app.js'])
</head>
<body>
  @if (Auth::check() && Auth::user()->is_admin == true)
    @include('partials.sidebar')
      <div class="p-4 lg:py-8 lg:px-12 lg:ml-[250px]">
        @yield('container')
      </div>
  @elseif (!request()->is('login') && !request()->is('register'))
    @include('partials.navbar')
      <div class="p-4 lg:py-8 lg:px-12">
        @yield('container')
      </div>
      @if (!request()->is('cart', 'order'))
        @include('partials.footer')
      @endif
  @endif

  {{-- feather icons --}}
  <script>
    feather.replace();
  </script>
  
</body>
</html>