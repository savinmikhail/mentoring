<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Codeboard Online IDE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}" /      >--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <link rel="stylesheet" type="text/css" href="../css/style.cs  s">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('showModule')}}">Наставничество</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('showModule')}}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Курсы</a>
                </li>
                <li class="nav-item">
                    @auth
                        <a href="{{ route('logout') }}" class="btn btn-outline-success" type="submit">Выйти</a>
                    @endauth
                </li>
                <!-- Добавьте другие пункты меню по вашему усмотрению -->
            </ul>
        </div>
    </nav>
</header>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <!-- Ваш контент с теорией -->
        </div>
        <div class="col-md-6">
            <!-- Ваш контент с редактором и кнопками -->
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/lib/ace.js"></script>

<script>
    // Ваш JavaScript код
</script>

</body>
</html>
