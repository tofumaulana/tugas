<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->title) {
        //     $book = Book::where('title', 'like', '%'.$request->title.'%')->get();
        // }else {
        //     $book = Book::all();
        // }       
        // return view('welcome', ['book'=>$book]);
        $query = Book::query();

        // Handle search based on selected criteria
        $search = $request->input('search');
        $searchBy = $request->input('search_by', 'title'); // Default to 'title'

        if ($search) {
            if ($searchBy === 'title') {
                $query->where('title', 'like', "%{$search}%");
            } elseif ($searchBy === 'code') {
                $query->where('code', 'like', "%{$search}%");
            } elseif ($searchBy === 'penulis') {
                $query->whereHas('penulis', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            }
        }

        $book = $query->get();

        // return view('welcome', compact('book'));
        // return view('welcome', ['book'=>$book]);
        return view('welcome', compact('book'));
    
    }
}
