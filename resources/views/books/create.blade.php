<x-basic pageName="Создать Книгу">

    <form method="POST" action="{{route('book.store')}}" enctype="multipart/form-data">
        @csrf
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
        <input  type="text" value="{{ old('title') }}" name="title"/>
        <label for="author">Автор книги</label>
        <input  type="text" value="{{ old('author') }}" name="author"/>
        <label for="published_year">Год издания</label>
        <input  name="published_year" value="{{ old('published_year') }}" required type="number" min="1800" max="{{ date('Y')  }}"/>
        <label for="description">Описание</label>
        <input type="text" value="{{ old('description') }}" name="description">
        <label for="path_to_image">Обложка книги</label>
        <input  name="path_to_image" type="file" accept="image/jpeg"/>
        <label for="genre">Выберите Жанр</label>
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
        <button type="submit">Создать</button>
    </form>

</x-basic>
