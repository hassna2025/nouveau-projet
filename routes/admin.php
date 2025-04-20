<?php
// routes/admin.php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\QuizController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Contents
    Route::resource('contents', ContentController::class);
    
    // Media
    Route::get('contents/{contentId}/media', [MediaController::class, 'index'])->name('admin.media.index');
    Route::post('contents/{contentId}/media/upload', [MediaController::class, 'upload'])->name('admin.media.upload');
    Route::delete('media/{id}', [MediaController::class, 'destroy'])->name('admin.media.destroy');
    
    // Quizzes
    Route::get('contents/{contentId}/quiz/create', [QuizController::class, 'create'])->name('admin.quizzes.create');
    Route::post('contents/{contentId}/quiz', [QuizController::class, 'store'])->name('admin.quizzes.store');
    Route::get('quizzes/{quizId}/questions', [QuizController::class, 'questions'])->name('admin.quizzes.questions');
    Route::post('quizzes/{quizId}/questions', [QuizController::class, 'storeQuestion'])->name('admin.quizzes.storeQuestion');
});