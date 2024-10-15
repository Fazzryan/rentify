<!doctype html>
<html lang="en">

<head>
    @include('fe.layouts.app_head')
</head>

<body>
    {{-- navbar --}}
    @stack('navbar')

    <div class="container" style="max-width: 768px;">

        @yield('content')

    </div>
    @include('fe.layouts.app_bottom')
    @include('be.layouts.app_script')
</body>

</html>
