<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'view'])->middleware(['auth'])->name('products.list');
Route::post('/products/create', [\App\Http\Controllers\ProductController::class, 'create'])->middleware(['auth'])->name('products.create');
Route::post('/products/edit', [\App\Http\Controllers\ProductController::class, 'edit'])->middleware(['auth'])->name('products.edit');
Route::delete('/products/delete/{id}', [\App\Http\Controllers\ProductController::class, 'delete'])->middleware(['auth'])->name('products.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
