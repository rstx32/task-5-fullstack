<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\PassportController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("v1")->group(function () {
    Route::post("/login", [PassportController::class, "login"])->name("login");
    Route::post("/register", [PassportController::class, "register"])->name("register");

    Route::middleware("auth:api")->group(function () {
        Route::get("/all", [PassportController::class, "users"]);

        Route::apiResource("articles", ArticleController::class);
        Route::apiResource("categories", CategoryController::class);
    });
});
