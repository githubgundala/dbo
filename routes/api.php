<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\OrderAPIController;

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



Route::prefix('auth')->group(function () {
    Route::post('login', [UserAPIController::class, 'login']);
    Route::post('register', [UserAPIController::class, 'register']);
    Route::any('{path}', function () {
        return response()->json([
            'message' => 'End point not found!',
        ], 404);
    });
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

// Route::post('/sanctum/token', function (Request $request) {
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('costumer', UserAPIController::class)->except([
        'login', 'register', 'show'
    ]);
    Route::post('logout', [UserAPIController::class, 'logout']);
    Route::resource('order', OrderAPIController::class);
});
// });

Route::any('{path}', function () {
    return response()->json([
        'message' => 'End point not found!',
    ], 404);
});