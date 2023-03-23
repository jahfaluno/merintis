<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('head-title')</title>
  {{-- SEO --}}
  @yield('meta-description')
  <meta name="keywords" content="Startup,UMKM,UKM,Daerah,Produksi,Merintis Indonesia,merintisindonesia,Madiun,Jawa Timur,Ide Bisnis,Technopreneur,Wirausaha,Startup Madiun,Digital,business ideas">
  <meta name="og:locale" content="id_ID">
  <meta name="og:type" content="website">
  <meta name="og:title" content="Merintis Indonesia">
  <meta name="og:description" content="Merintis Indonesia - Connect, Collaborate & Create">
  <meta name="og:url" content="https://merintisindonesia.com">
  <meta name="og:site_name" content="Merintis Indonesia">
  <meta name="og:image" content="https://merintisindonesia.com/assets/img/Logo-MI.png">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Merintis Indonesia">
  <meta name="twitter:description" content="Yuk Jadi Pengusaha Muda Bersama Merintis Indonesia!">
  {{-- END SEO --}}

  {{-- Favicons --}}
  <link href="{{ asset('favicon.png') }}" type="image/png" rel="icon">
  <link href="{{ asset('apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link rel="stylesheet" href= "{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
  <script src="https://use.fontawesome.com/60a313a36b.js"></script>

  @yield('addCSS')
</head>
<body>
  {{-- ================ Header Menu Area start ================= --}}
  @yield('header')
  {{-- ================ END Header Menu Area ================= --}}

  @yield('content')

  @yield('footer')

  <script src="{{ asset('assets/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
  @yield('addScript')
</body>
</html>
