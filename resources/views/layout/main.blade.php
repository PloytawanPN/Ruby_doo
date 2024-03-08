<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/sidebar.css') }}" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @yield('style')
    <title>Document</title>
    @livewireStyles
</head>
<body>
    @include('layout.sidebar')
    <div class="home_content">
        @yield('content')
    </div>
    @livewireScripts
    <script src={{asset('assets/js/sidebar.js')}}></script>
    @yield('script')
</body>
</html>
