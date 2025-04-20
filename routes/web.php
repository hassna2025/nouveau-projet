<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentification
Auth::routes([
    'register' => true,
    'reset' => true,
    'verify' => false
]);
// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route de test
Route::get('/category-test', [CategoryController::class, 'test']);

// Espace client
Route::middleware(['auth'])->group(function () {
    Route::get('/categories', [ClientController::class, 'index'])->name('client.categories');
    Route::get('/categories/{id}', [ClientController::class, 'showCategory'])->name('client.category.show');
    Route::get('/contents/{id}', [ClientController::class, 'showContent'])->name('client.content.show');
    
    // Quiz
    Route::get('/quiz/start/{contentId}', [ClientController::class, 'startQuiz'])->name('client.quiz.start');
    Route::post('/quiz/submit/{quizId}', [ClientController::class, 'submitQuiz'])->name('client.quiz.submit');
});

// Espace admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
});
