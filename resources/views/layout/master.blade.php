<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale())">
<head>
   @include('layout.head')
</head>
<body>
<div class="container">
     <header class="row">
       @include('layout.header')
      </header>

      <div id="main" class="row justify-content-center mt-5">
         @yield('content')
      </div>
</div>
</body>
</html>