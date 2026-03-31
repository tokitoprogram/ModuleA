<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::where('user_id', Auth::id())->with('genre')->latest()->paginate(5);

        return view('home', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();

        return view('books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bookData = $request->validate([

            'title'=>['required',  'max:100', 'string'],
            'author'=>['required', 'max:100', 'string'],
            'published_year'=>['required','integer','digits:4','between:1800,'. date('Y')],
            'description'=>['nullable', 'string','max:500'],


            'path_to_image'=>['max:3072','image','nullable','mimes:jpeg, jpg'],
            'genre_id'=>['required', 'exists:genres,id'],
            'currentPage'=>['integer','min:0', 'nullable'],
        ]);

        if ($request->hasFile('path_to_image')) {
            $file = $request->file('path_to_image');
            $bookData['path_to_image'] = $this->resizeAndCover($file);
        }

        $bookData['user_id']=Auth::id();

        $book = Book::create($bookData);
        return redirect()->route('book.show', $book);
//        return redirect()->route('book.show', $book->id)->with('success', 'Книга успештно добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Доступ запрещен');
        }

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Доступ запрещен');
        }
        $genres = Genre::all();

        return view('books.edit', compact('book', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Доступ запрещен');
        }
        $bookData = $request->validate([

            'title'=>['required', 'max:100', 'string'],
            'author'=>['required', 'max:100', 'string'],
            'published_year'=>['required','integer','digits:4','between:1800,'. date('Y')],
            'description'=>['nullable', 'string','max:500'],


            'path_to_image'=>['max:3072','image','nullable','mimes:jpeg, jpg'],
            'genre_id'=>['required', 'exists:genres,id'],
            'currentPage'=>['integer','min:0', 'nullable'],
        ]);
        if ($request->hasFile('cover')) {
            // Удаляем старую обложку
            if ($book->path_to_image) {
                File::delete(public_path($book->path_to_image));
            }
            $bookData['path_to_image'] = $this->resizeAndCover($request->file('cover'));
        }
        $book->update($bookData);

        return redirect()->route('book.show', $book);
    }
    private function resizeAndCover($file)
    {
        $name = time() . '_' . $file->getClientOriginalName();
        $path = public_path('covers/' . $name);
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        $img = imagecreatefromjpeg($file->getRealPath());
        $ratio = min(300 / imagesx($img), 450 / imagesy($img));
        $out = imagecreatetruecolor(imagesx($img) * $ratio, imagesy($img) * $ratio);
        imagecopyresampled($out, $img, 0,0,0,0, imagesx($out), imagesy($out),  imagesx($img), imagesy($img) );
        imagejpeg($out, $path);
        return 'covers/' . $name;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Доступ запрещен');
        }
        Book::destroy($book->id);
        return redirect()->route('home');
    }
}
