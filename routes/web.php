<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;

// Главная страница с выводом новостей
Route::get('/', function () {
    return redirect()->route('news.index');});
Route::get('/news', [PostController::class, 'index'])->name('news.index');
Route::get('/news/{post}', [PostController::class, 'show'])->name('news.show');



Route::get('/dashboard', function () {
    return redirect()->route('news.index'); // Перенаправление на главную страницу
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/news/create', [PostController::class, 'create'])->name('news.create'); // Страница создания новости
    Route::post('/news', [PostController::class, 'store'])->name('news.store'); // Обработка формы
});

require __DIR__.'/auth.php';
