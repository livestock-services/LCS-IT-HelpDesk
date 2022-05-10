<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/myCustomjs/custom.js') }}" defer></script>
    <script src="{{ asset('Ninestars/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('Ninestars/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Ninestars/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('Ninestars/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('Ninestars/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('Ninestars/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  
  <!-- Template Main JS File -->
  <script src="{{ asset('Ninestars/assets/js/main.js') }}"></script> 

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('Ninestars/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('Ninestars/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Ninestars/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Ninestars/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Ninestars/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Ninestars/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
    <link href="{{ asset('Ninestars/assets/css/style.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/myCustomCss/custom.css') }}" rel="stylesheet">
</head>
<body>
  
    <div id="app">
      
    @include('inc.navbar') 
    @include('inc.navbar') 
        @if(Auth::guard('web')->check())
          @include('inc.navbar')  
        @elseif(Auth::guard('admin')->check())
          @include('inc.navbarAdmin')
        @else
          @include('inc.navbar')
        @endif
        <main class="py-4">
        <div class="container">
            @include('inc.messages')
            @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
