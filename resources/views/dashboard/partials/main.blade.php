<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.partials.header')
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include('dashboard.partials.sidebar')
        
        <div class="body-wrapper">
            @include('dashboard.partials.navbar')

            <div class="container-fluid">
                @yield('dashboard')

                <div class="card" style="margin: -10px !important;">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mt-4 mb-1">@yield('title')</h5>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('logout') }}" style="display: none;" method="post" id="logoutForm">
            @csrf
        </form>
        
        @yield('modal')
        @include('dashboard.partials.footer')
    </div>
</body>
</html>