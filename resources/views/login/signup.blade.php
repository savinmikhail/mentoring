@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Регистрация</h1>
        <form action="" method="POST">
            @csrf
            <label>
                <input type="text" name="name" placeholder="Имя" required />
            </label>
            <label>
                <input type="email" name="email" placeholder="Email" required />
            </label>
            <label>
                <input type="password" name="password" placeholder="Пароль" required />
            </label>
            <button type="submit" >Sign Up</button>
        </form>

    </div>
    <div class="text-center">Есть аккаунт? <a href="/signin">Войти</a></div>
    <a href="{{route('user.vk')}}">Вход через VK</a>
@endsection

