<?php

use App\Http\Controllers\JoinController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Mail;
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


Route::resource('/join', JoinController::class);
Route::resource('/mail', MailController::class);


Route::get('/featured', function () {
    return view('featured');
});

Route::get(
    '/dashboard',
    [JoinController::class, 'dashboard']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::delete('dashboard/{id}', [JoinController::class, 'destroy'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
