@extends('layout.app')

@section('content')
    <body>
    <div class="container">
        <h1>Sign in</h1>
        <form action="" method="POST">
            @csrf

            <label>
                <input type="email" name="email" placeholder="Email" required />
            </label>

            <label>
                <input type="password" name="password" placeholder="Password" required />
            </label>


            <button type="submit">Sign In</button>

        </form>

    </div>
    <div class="text-center">Нет аккаунта?<a href="/signup">Зарегистрироваться</a></div>
    <a href="{{route('user.vk')}}">Вход через VK</a>
    </body>
@endsection






