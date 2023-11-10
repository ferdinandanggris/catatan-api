<?php

use App\Http\Controllers\Api\CatatanController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("catatan")->group(function(){
    Route::post("/", [CatatanController::class, "store"]);
    Route::get("/", [CatatanController::class, "index"]);
    Route::put("/{id}", [CatatanController::class, "update"]);
    Route::get("/{id}", [CatatanController::class, "show"]);
    Route::delete("/{id}", [CatatanController::class, "destroy"]);
});
