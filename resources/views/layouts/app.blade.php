<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body>
<div class="page-wrap">
    @include('layouts.header')
    <div id="app-body">
        @yield('body')
    </div>
</div>
@include('layouts.footer')
</body>
</html>
