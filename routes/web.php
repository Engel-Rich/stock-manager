<?php


use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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

Route:: middleware('auth')-> group(function () {
  Route::get('/', [ArticleController::class, 'index'])->name('article.index');  
  Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');  
  Route::get('/article/edit/${article}', [ArticleController::class, 'edit'])->name('article.edit');  
  Route::get('/article/mouvements/${article}', [ArticleController::class, 'mouvements'])->name('article.mouvements');  
  Route::put('/article/update/${id}', [ArticleController::class, 'update'])->name('article.update');  
  Route::post('/article/transactions', [ArticleController::class, 'transactions'])->name('article.transactions');  
  Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');  
});

/// Lgin and Register routes 

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('auth.login');
    Route::get('/register', [UserController::class, 'register'])->name('auth.register');
    Route::post('/register', [UserController::class, 'store'])->name('auth.store');
    Route::post('/login', [UserController::class, 'signIn'])->name('auth.signin');
});

// require __DIR__.'/auth.php';
