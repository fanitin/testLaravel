<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="icon" href="/calcicon.svg">
</head>

<body class="bg-dark"><header class="d-flex flex-wrap align-items-center justify-content-between justify-content-md-between py-3 mb-4 border-bottom bg-dark">
    <ul class="nav col-12 col-md-auto mb-2 justify-content-start mb-md-0">
        <li><a href="{{route('home.index')}}" class="nav-link px-2 link-secondary text-white">Strona główna</a></li>
        <li><a href="{{route('calc.index')}}" class="nav-link px-2 link-dark text-white">Oblicz</a></li>
        @if (Auth::check() && Auth::user()->hasRole(['admin', 'worker']))
            <li><a href="{{route('result.index')}}" class="nav-link px-2 link-dark text-white">Poprzednie wyniki</a></li>
        @endif
    </ul>

    <div class="col-md-3 text-end ms-auto">
        <div class="dropdown">
            @guest
                @if (Route::has('login'))
                    <button class="btn btn-warning btn-as-link" onclick="window.location.href='{{ route('login') }}'">{{ __('Login') }}</button>
                @endif
                @if (Route::has('register'))
                    <button onclick="window.location.href='{{ route('register') }}'" class="btn btn-primary btn-as-link">{{ __('Register') }}</button>
                @endif
            @else
                <a id="navbarDropdown" class="btn btn-warning rounded-3 mr-3 px-3 d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                    <span class="dropdown-toggle-icon"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->hasRole(['admin']))
                        <a href="{{ route('admin.home.index') }}" class="dropdown-item">Panel administratora</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    
                </div>
            @endguest
        </div>
    </div>
</header>


    <div class="container">
        @yield('main_content')
        <br>
    </div>

    @if ($errors->any())
    <div class="container alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Ваши AJAX-запросы и другие скрипты здесь
    });
</script>
</body>

</html>
