<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();
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
        $totalBooks = $book->count();
        // return view('welcome', compact('book', 'totalBooks')); 
        if ($request->ajax()) {
            $html = view('partials.books_list', ['book' => $book])->render();
            return response()->json([
                'html' => $html,
                'totalBooks' => $totalBooks
            ]);
        }

        return view('welcome', [
            'book' => $book,
            'totalBooks' => $totalBooks
        ]);
    }
    

    // public function getBooksData(Request $request)
    // {
    //     $query = Book::query();
    //     $search = $request->input('search');
    //     $searchBy = $request->input('search_by', 'title'); // Default to 'title'

    //     if ($search) {
    //         if ($searchBy === 'title') {
    //             $query->where('title', 'like', "%{$search}%");
    //         } elseif ($searchBy === 'code') {
    //             $query->where('code', 'like', "%{$search}%");
    //         } elseif ($searchBy === 'penulis') {
    //             $query->whereHas('penulis', function ($query) use ($search) {
    //                 $query->where('name', 'like', "%{$search}%");
    //             });
    //         }
    //     }

    //     $book = $query->get();
    //     $totalBooks = $book->count();
        
    //     return response()->json([
    //         'totalBooks' => $totalBooks,
    //         'book' => $book->map(function ($book) {
    //             return [
    //                 'id' => $book->id,
    //                 'title' => $book->title,
    //                 'code' => $book->code,
    //                 'penulis' => $book->penulis ? $book->penulis->name : null,
    //             ];
    //         }),
    //     ]);
    
    
    // }

    // public function apiIndex(Request $request)
    // {
    //     $query = Book::query();
    //     $search = $request->input('search');
    //     $searchBy = $request->input('search_by', 'title');

    //     if ($search) {
    //         if ($searchBy === 'title') {
    //             $query->where('title', 'like', "%{$search}%");
    //         } elseif ($searchBy === 'code') {
    //             $query->where('code', 'like', "%{$search}%");
    //         } elseif ($searchBy === 'penulis') {
    //             $query->whereHas('penulis', function ($query) use ($search) {
    //                 $query->where('name', 'like', "%{$search}%");
    //             });
    //         }
    //     }

    //     $book = $query->get();
    //     $totalBooks = $book->count();

    //     return response()->json([
    //         'book' => $book,
    //         'totalBooks' => $totalBooks,
    //     ]);
    // }
}
