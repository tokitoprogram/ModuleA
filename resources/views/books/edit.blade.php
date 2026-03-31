<x-basic pageName="Создать Книгу">
    <h1 style="text-align: center; padding-block: 20px">Редактироать книгу</h1>
    <form method="POST" action="{{route('book.update', $book)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif
        <label for="title">Название книги</label>
        <input  type="text" value="{{$book->title}}" name="title"/>
        <label for="author">Автор книги</label>
        <input  type="text" value="{{ $book->author }}" name="author"/>
        <label for="published_year">Год издания</label>
        <input  name="published_year" value="{{ $book->published_year }}" required type="number" min="1800" max="{{ date('Y')  }}"/>
        <label for="description">Описание</label>
        <input type="text" value="{{ $book->description }}" name="description">
        <label for="path_to_image">Обложка книги
            @if($book->path_to_image)
                <img src="{{ asset($book->path_to_image) }}" style="max-width: 200px;">
            @endif
        </label>
        <input  name="path_to_image" type="file"  accept="image/jpeg"/>
        <label for="genre">Изменить Жанр</label>
        <select name="genre_id"  required id="">
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <label for="currentPage">Текущая страница</label>
        <input
            type="number"
            name="currentPage"
            id="currentPage"
            min="0"
            value="{{ old('currentPage', 0) }}"
        />
        @error('currentPage') <div>{{ $message }}</div> @enderror
        <button type="submit">Изменить</button>
    </form>
    <form action="{{route('book.destroy', $book)}}" method="POST">
        <button type="submit">Удалить</button>
    </form>

</x-basic>
