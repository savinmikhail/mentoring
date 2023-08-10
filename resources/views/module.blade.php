<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ваша страница</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@include('layout.navbar')

<!-- Тело страницы -->
    <div class="container">
        <h1>Список модулей и уроков</h1>
        @foreach($modules as $module)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    {{ $module->title }} <!-- Предполагается, что у модуля есть поле 'name' -->
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($module->lessons as $lesson)
                            <a href="{{route('showLesson', ['id' => $lesson->id])}}">{{ $lesson->title }}</a>
                        @endforeach
                    </ul>
                </div>
                {{ $module->description }}
            </div>
        @endforeach
    </div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
