<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Kategori;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Book::with(['kategori', 'penulis'])->get();
        return view('book.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        return view('book.create', compact('kategori', 'penulis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'code' => 'nullable|string|max:255|unique:books',
            'description' => 'nullable|string',
            'kategori_id' => 'required',
            'penulis_id' => 'required|exists:penulis,id',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ])->validate();

        $filePath = public_path('book_img');
        $insert = new Book();
        $insert->title = $request->title;
        $insert->code = $request->code;
        $insert->description = $request->description;
        $insert->kategori_id = $request->kategori_id;
        $insert->penulis_id = $request->penulis_id;
        $insert->cover_image = $request->cover_image;

        if ($request->hasfile('cover_image')) {
            $file = $request->file('cover_image');
            $file_name = time() . $file->getClientOriginalName();

            $file->move($filePath, $file_name);
            $insert->cover_image = $file_name;
        }

        $foto_file = $request->file('cover_image');
        $result = $insert->save();
        Session::flash('success', 'User registered succesfully');
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $kategori = Kategori::all(); // Assuming you have a Category model
        $penulis = Penulis::all();       
        return view('book.edit',  compact('book', 'kategori', 'penulis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'code' => 'nullable|string|max:255|unique:books',
            'description' => 'nullable|string',
            'kategori_id' => 'required',
            'penulis_id' => 'required|exists:penulis,id',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ])->validate();
        $update = Book::findOrFail($id);
        $update->title = $request->title;
        $update->code = $request->code;
        $update->description = $request->description;
        $update->kategori_id = $request->kategori_id;
        $update->penulis_id = $request->penulis_id;

        if ($request->hasfile('cover_image')){
            $filePath = public_path('book_img');
            $file = $request->file('cover_image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);
            //delet old cover_image
            if (!is_null($update)) {
                $oldImage = public_path('book_img/' . $update);
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $update->cover_image = $file_name;
        }
        $result = $update->save();
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        if (!is_null($book->cover_image)){
            $cover_image = public_path('book_img/'. $book->cover_image);
            if (File::exists($cover_image)){
                unlink($cover_image);
            }
        }
        return redirect()->route('books.index');
    }
}
