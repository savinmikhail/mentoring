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
    <style>
        body {
            /* Установите фоновое изображение */
            /*background-image: url('https://static.tildacdn.com/tild6235-6535-4332-b137-616435626434/2222.svg');*/
            /*background-image: url('https://mir-s3-cdn-cf.behance.net/project_modules/fs/74943893890387.5e70ade47b152.png');*/
            /* Настройте свойства фона */
            background-size: cover; /* Настройте, как изображение покрывает фон */
            background-repeat: no-repeat; /* Предотвратите повторение изображения на фоне */
            background-attachment: fixed; /* Сделайте фон неподвижным при прокрутке */
            background-color: #ffffff; /* Сделайте фон неподвижным при прокрутке */

            /* Добавьте другие стили по необходимости */
        }
    </style>


</head>
<body >

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand  text-white" href="{{route('showModule')}}">Наставничество</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item">
                  <a class="nav-link  text-white"  > <?php echo 'Прогресс: '. auth()->user()->progress ?></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link  text-white" href="{{route('showModule')}}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-white" href="#">Курсы</a>
                </li>
                <li class="nav-item">
                    @auth
                        <a href="{{ route('logout') }}" class="btn btn-outline-success" type="submit">Выйти</a>
                    @endauth
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container mt-4">

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/lib/ace.js"></script>

<script>
    // Ваш JavaScript код
</script>

</body>
</html>
