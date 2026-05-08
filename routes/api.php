<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// ini ada route yang salah
// Route::post('/register', function (Request $request) {
//     DB::table('users')->insert([
//         'name' => $request->name,
//         'email' => $request->email,
//         'password' => $request->password
//     ]);

//     return response()->json(['message' => 'Register berhasil']);
// });

// Route::post('/login', function (Request $request) {
//     $user = DB::table('users')
//         ->where('email', $request->email)
//         ->where('password', $request->password)
//         ->first();

//     if ($user) {
//         return response()->json([
//             'message' => 'Login berhasil',
//             'user' => $user
//         ]);
//     }

//     return response()->json(['message' => 'Login gagal']);
// });

// Route::get('/admin', function () {
//     return response()->json([
//         'message' => 'Halaman admin'
//     ]);
// });

//kode yang benar
Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ]);

    DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user'
    ]);

    return response()->json([
        'message' => 'Register berhasil'
    ]);
});

Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = DB::table('users')
        ->where('email', $request->email)
        ->first();

    if ($user && Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user
        ]);
    }

    return response()->json([
        'message' => 'Login gagal'
    ], 401);
});

Route::middleware(['admin'])->get('/admin', function () {
    return response()->json([
        'message' => 'Halaman admin'
    ]);
});