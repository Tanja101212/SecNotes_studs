<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// 5|2pQv7ZYZFKJygZhxkUriJ0lByorgrjZ1WNEeumgr936859d5



Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request){
        return $request->user();
    });

    Route::get('notes', [\App\Http\Controllers\RestController::class, 'index'])
        ->middleware(['abilities:note:list']);
});
