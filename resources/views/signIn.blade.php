<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Войти</title>
    <!-- Подключение Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Войти</h1>
            <form action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-6 text-center">
            <p>Нет аккаунта? <a href="/signup">Зарегистрироваться</a></p>
        </div>
    </div>
</div>

<!-- Подключение Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
