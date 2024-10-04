<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    
    Route::apiResource('tasks',TasksController::class);
});
