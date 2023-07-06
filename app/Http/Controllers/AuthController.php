<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['message' => 'Yanlış kullanıcı adı veya şifre'], 404);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    function register(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        try {
            User::create($data);
            return response()->json(['message' => 'Kayıt başarıyla oluşturuldu'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Kayıt oluşturulurken hata oluştu'], 500);
        }

    }
}
