<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** 辞書関連 */
Route::prefix('/dictionary')->group(function () {
    Route::get('/word-search', \App\Http\Controllers\Dictionary\WordSearchController::class);
});
