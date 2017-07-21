<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Stories @yield('title')</title>

  <link rel="stylesheet" href="/css/app.css">
  @yield('styles')
</head>
<body>
  @include('shared.header')

  @yield('content')

  @include('shared.footer')

  <script language="javascript" type="text/javascript" src="/js/app.js"></script>
  @yield('scripts')
</body>
</html>
