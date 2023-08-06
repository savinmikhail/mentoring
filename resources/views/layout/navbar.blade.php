<nav class="navbar bg-light border-bottom">
    <div class="container justify-content-center">
        <div class="col-lg-6">
            <a class="ml-0 navbar-brand text-primary" href="">
                Успешный успех
            </a>
            <span class="navbar-text d-none d-md-inline">тут будет описание сайта</span>

        </div>
        <div class="col-1 d-none d-md-block">
            <ul class="nav float-end navbar-nav">
                <li class="nav-item dropdown text-end">
                    <a href="" class="btn btn-outline-success" type="submit">?</a>
                </li>
                <li class="nav-item dropdown text-end">
                    @auth
                        <a href="" class="btn btn-outline-success" type="submit">Моё обучение</a>
                    @endauth
                </li>
            </ul>
        </div>
        <div class="col-1">
            <ul class="nav float-start navbar-nav">
                    @auth
                        <span class="navbar-text">
                            {{ Auth::user()->name }}
                        </span>
                    @endauth
            </ul>
        </div>
        <div class="col-1">
            @auth
                <a href="" class="btn btn-outline-success" type="submit">Выйти</a>
            @endauth
            @guest
                 <a href="" class="btn btn-outline-success" type="submit">Войти</a>
            @endguest
        </div>
    </div>
</nav>
