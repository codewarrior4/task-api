<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->json(['success'=>false, 'message' => 'Page Not Found.'], 404);
});

