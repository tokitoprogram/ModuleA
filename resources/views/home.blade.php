<x-basic pageName="Главная">

    <section class="books">
        <h1>Мои книги</h1>
        @auth
            <ul>
                @foreach($books as $book)
                    <li>
                        <img src="{{$book->path_to_image}}" class="book-image" alt="">
                        <h3 class="title">{{ $book->title }}</h3>
                        <h4 class="author">Автор : {{ $book->author }}</h4>
                        <p class="genre">Жанр: {{$book->genre->name}}</p>
                        <p class="description">LOrem isum LOrem isumLOrem isumLOrem isumLOrem isumLOrem isumLOrem isumLOrem isumLOrem isumLOrem isum</p>
                        <div class="published_at">Выпущена в {{ $book->published_year }}</div>
                        <div class="currentPage">Текущая страница: {{ $book->currentPage }}</div>
                        <a href="{{ route('book.show', $book) }}">Поподробнее</a>
                        <form action="{{route('book.destroy', $book)}}" method="POST">
                            <button type="submit">Удалить</button>
                        </form>

                        <a href="{{route('book.edit', $book)}}">Редактировать</a>

                    </li>
                @endforeach
            </ul>
            <div style="width: 60px;display: flex">
                {{ $books->links() }}
            </div>
        @endauth
        @guest
            Ваших книг нету Зарегистрируйтесь или Войдите
        @endguest
    </section>

</x-basic>
