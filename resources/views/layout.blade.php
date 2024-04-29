<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-dark">
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom bg-dark">
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="/" class="nav-link px-2 link-secondary text-white">Strona główna</a></li>
            <li><a href="/calc" class="nav-link px-2 link-dark text-white">Oblicz</a></li>
            <li><a href="/results" class="nav-link px-2 link-dark text-white">Poprzednie wyniki</a></li>
        </ul>
        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-warning">Login</button>
            <button type="button" class="btn btn-primary">Sign-up</button>
        </div>
    </header>


    <div class="container">
        @yield('main_content')
    </div>

</body>

</html>
