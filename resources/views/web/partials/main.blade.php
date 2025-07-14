<!DOCTYPE html>
<html lang="en">
<head>
    @include('web.partials.header')
</head>
<body>
    {{-- @include('web.partials.loader') --}}
    <div class="fh5co-loader"></div>
    <div class="page">
        @include('web.partials.navbar')

        @yield('content')
    </div>
    @include('web.partials.footer')
</body>
</html>