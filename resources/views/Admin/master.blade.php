<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token for private puusher brodcastng -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  

  {!! SEO::generate() !!}

    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    @include('Admin.section.header')
        @yield('content')
    @include('Admin.section.footer')

    <link rel="stylesheet" href="/css/sweetalert.css">
    <script src="/js/sweetalert.min.js"></script>
      @include('sweet::alert')
</body>
</html>
