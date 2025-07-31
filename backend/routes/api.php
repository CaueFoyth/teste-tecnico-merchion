<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Controllers\API\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');

    Route::post('/login', 'login')
        ->middleware([StartSession::class, 'throttle:60,1']);
});
