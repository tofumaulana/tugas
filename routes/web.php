<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenulisController;
// use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PublicController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/kategori/index', function () {
        return view('kategori.index');
    })->name('kategori.index');
    Route::get('/kategori/create', function () {
        return view('kategori.create');
    })->name('kategori.create');
    Route::get('/penulis', function () {
        return view('penulis.index');
    })->name('penulis.index');
    Route::get('/penulis/create', function () {
        return view('penulis.create');
    })->name('penulis.create');
    Route::get('/roles/index', function () {
        return view('roles.index');
    })->name('roles.index');
    Route::get('/users/index', function () {
        return view('users.index');
    })->name('users.index');
    Route::get('/customer/dashboard', function () {
        return view('customer/dashboard');
    })->name('customer/dashboard');
    // Route::get('/book/index', function () {
    //     return view('book.index');
    // })->name('book.index');
    // Route::get('/book/create', function () {
    //     return view('book.create');
    // })->name('book.create');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/penulis', [PenulisController::class, 'index'])->name('penulis');
    Route::get('/book', [BookController::class, 'index'])->name('book');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer/dashboard');
});

// Route::middleware(['auth'])->group(function () {
//     Route::middleware(['role:customer'])->group(function(){
//         Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
//     });
    
//     Route::middleware(['role:admin'])->group(function(){ 
//         Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');   
//         Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    
//         Route::get('/penulis', [PenulisController::class, 'index'])->name('penulis');
//         Route::get('/penulis/create', [PenulisController::class, 'create'])->name('penulis.create');
    
//     });
// });


Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori/store');
// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori/edit');
Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/edit/{id}', [KategoriController::class, 'update'])->name('kategori/update');
Route::delete('/kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/penulis', [PenulisController::class, 'index'])->name('penulis.index');
Route::post('/penulis/store', [PenulisController::class, 'store'])->name('penulis/store');
Route::get('penulis/edit/{id}', [PenulisController::class, 'edit'])->name('penulis.edit');
Route::put('/penulis/edit/{id}', [PenulisController::class, 'update'])->name('penulis/update');
Route::delete('/penulis/destroy/{id}', [PenulisController::class, 'destroy'])->name('penulis.destroy');
Route::get('/penulis/getSlug', [PenulisController::class, 'getSlug'])->name('penulis/getSlug');

// Route::get('/book/index', [BookController::class, 'index'])->name('book.index');
// Route::get('book/create', [BookController::class, 'create'])->name('book.create');
// Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
// Route::get('book/{id}', [BookController::class, 'show']);
// Route::put('book/{id}', [BookController::class, 'update']);
// Route::delete('book/{id}', [BookController::class, 'destroy']);
Route::resource('books', BookController::class);

