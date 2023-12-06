<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LibroController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signup', [ AuthController::class, 'signup']);
Route::post('login', [ AuthController::class, 'login']);

Route::prefix('libros')->group(function () {

    Route::get('/',[ LibroController::class, 'get']);
    Route::get('/{id}',[ LibroController::class, 'getById']);
    Route::get('/filter',[ LibroController::class, 'filter']);
    Route::post('/',[ LibroController::class, 'create']);
    Route::put('/{id}',[ LibroController::class, 'update']);
    Route::delete('/{id}',[ LibroController::class, 'delete']);

});