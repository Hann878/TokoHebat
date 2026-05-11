<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //Ini merupakan kode Yoga yang salah

    // public function register(Request $request){
    //     DB::table('users')->insert([
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => $request->password
    //      ]);
    // return response()->json(['message' => 'Register berhasil']);
    // }

    // public function login(Request $request){
    //     $user = DB::table('users')
    //     ->where('email', $request->email)
    //     ->where('password', $request->password)
    //     ->first();

    // if ($user) {
    //     return response()->json([
    //         'message' => 'Login berhasil',
    //         'user' => $user
    //     ]);
    // }
    // return response()->json(['message' => 'Login gagal']);
    // }

    //ini merupakan kode Yoga yang telah diperbaiki
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password'=> 'required|min:8'
        ]);

        try {
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password'=> Hash::make($request->password),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json(["message" => "Register Berhasil"]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('users')
        ->where('email', $request->email)
        ->first();

        if($user && Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Login Berhasil',
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'Login Gagal'
        ], 401);
    }
}