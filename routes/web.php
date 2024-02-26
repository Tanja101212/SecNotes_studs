<?php

use App\Http\Controllers\NoteController;
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

    $users = \App\Models\User::all();

    return view('dashboard', ['users' => $users]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //
    Route::get('/notes/{note:id}/show', [NoteController::class, 'show'])
        ->middleware(['auth'])
        ->name('notes.show');
    Route::get('/notes/{note:id}/edit',
        [NoteController::class, 'edit'])
        ->middleware(['auth'])
        ->name('notes.edit');
    Route::patch('/notes/{note}/favorite', [NoteController::class, 'favorite'])
        ->middleware(['auth']);
    Route::patch('/notes/{note}',
        [NoteController::class, 'update'])
        ->middleware(['auth']);
    Route::get('/notes', [NoteController::class,'index']) ->name('notes.index')
        ->middleware(['auth'])
    ;

    Route::post('/notes', [NoteController::class, 'store'])
        ->middleware(['auth'])
    ;



    Route::post('/notes/{note}/duplicate', [NoteController::class, 'duplicate'])
        ->middleware(['auth'])
    ;

    Route::delete('/notes/{note}', [NoteController::class, 'destroy']);

    //Profile

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// USers

Route::post('/users', [NoteController::class, 'createUser'])
    ->middleware(['auth'])
;

// Tokens
Route::get('/tokens',[\App\Http\Controllers\TokenController::class,'index'])->name('tokens');
require __DIR__.'/auth.php';
