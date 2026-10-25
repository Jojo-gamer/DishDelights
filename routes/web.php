<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);
    Route::patch('/recipes/{recipe}/active', [RecipeController::class, 'updateActiveState'])
        ->name('recipes.active');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin', function () {
    return 'Admin page';    //temporary, later also gonna use controller
})->can('admin')->name('admin');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::resource('recipes', RecipeController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';
