<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


// ini ada route yang salah
Route::post('/register', function (Request $request) {
    DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password
    ]);

    return response()->json(['message' => 'Register berhasil']);
});

Route::post('/login', function (Request $request) {
    $user = DB::table('users')
        ->where('email', $request->email)
        ->where('password', $request->password)
        ->first();

    if ($user) {
        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user
        ]);
    }

    return response()->json(['message' => 'Login gagal']);
});

Route::get('/admin', function () {
    return response()->json([
        'message' => 'Halaman admin'
    ]);
});