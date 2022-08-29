<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(
//     [
//         'middleware' => 'auth:sanctum'
//     ],
//     function(){

//     }
// )

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::controller(AuthController::class)->group(function(){
//     Route::post('/auth/login/email','login');
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/me/user/favourite/post-analysis/{id}', [PostController::class, 'unfavourite']);
    Route::post('/me/user/favourite/post-analysis/{id}', [PostController::class, 'favourite']);
    Route::get('/me/user/favourite/post-analysis', [PostController::class, 'favouriteIndex']);
    Route::get('/me/user/info', [AuthController::class, 'checkMe']);
    Route::post('/me/user/logout', [AuthController::class, 'logout']);
});

Route::get('/post/analysis', [PostController::class, 'index']);
Route::post('/auth/login/email', [AuthController::class, 'login']);
// Route::post('/me/user/logout',AuthController::class,'logout');