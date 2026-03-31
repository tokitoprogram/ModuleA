<header>
    <div class="container">
        <a href="{{route('home')}}">Мои книги</a>
        @auth
            <ul>
                <li><a href="{{ route('book.create') }}">Создать книг</a></li>
            </ul>
        @endauth
        <ul>
            @guest
            <li>
                <a href="{{route('login')}}">Вход</a>
            </li>
            <li>
                <a href="{{route('registration')}}">Регистрация</a>
            </li>
            @endguest
            @auth
            <li>
                <form action="{{route('logout')}}" method="POST">
                    <button type="submit">Выйти</button>
                </form>
            </li>
            @endauth
        </ul>
    </div>
</header>
