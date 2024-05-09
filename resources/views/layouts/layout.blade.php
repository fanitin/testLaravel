<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="icon" href="/calcicon.svg">
</head>

<body class="bg-dark">
    <header class="d-flex flex-wrap align-items-center justify-content-between justify-content-md-between py-3 mb-4 border-bottom bg-dark">
        <ul class="nav col-12 col-md-auto mb-2 justify-content-start mb-md-0">
            <li><a href="{{route('home.index')}}" class="nav-link px-2 link-secondary text-white">Strona główna</a></li>
            <li><a href="{{route('calc.index')}}" class="nav-link px-2 link-dark text-white">Oblicz</a></li>
            <li><a href="{{route('result.index')}}" class="nav-link px-2 link-dark text-white">Poprzednie wyniki</a></li>
        </ul>
        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-warning">Login</button>
            <button type="button" class="btn btn-primary">Sign-up</button>
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
</body>

</html>
