<x-basic pageName="Главная">

    <section class="books">
        <h1>{{$book->title}}</h1>

            <ul>

                    <li>
                        <img src="{{$book->path_to_image}}" class="book-image" alt="">
                        <h3 class="title">{{ $book->title }}</h3>
                        <h4 class="author">Автор : {{ $book->author }}</h4>
                        <p class="genre">Жанр: {{$book->genre->name}}</p>
                        <p class="description">{{$book->description}}</p>
                        <div class="published_at">Выпущена в {{ $book->published_year }}</div>
                        <div class="currentPage">Текущая страница: {{ $book->currentPage }}</div>
                        <a href="{{ route('book.edit', $book) }}">Редактировать</a>
                        <form action="{{route('book.destroy', $book)}}" method="POST">
                            <button type="submit">Удалить</button>
                        </form>



                    </li>

            </ul>
    </section>

</x-basic>
