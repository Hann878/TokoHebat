<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return('Error'); 
});


Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['admin'])->get('/admin', function () {
    return response()->json([
        'message' => 'Halaman admin'
    ]);
});