<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'       => ['required', 'email'],
            'password'    => ['required'],
            'device_name' => ['required', 'string', 'max:100'],
            'read_only'   => ['nullable', 'boolean'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверный e-mail или пароль'],
            ]);
        }

        // Задание 3: проверка флага read_only и ролей
        $isReadOnly = $request->boolean('read_only', false);

        if ($isReadOnly) {
            $abilities = ['read'];
        } else {
            $abilities = in_array($user->role, ['admin', 'editor']) ? ['read', 'write'] : ['read'];
        }

        $token = $user->createToken($data['device_name'], $abilities)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => new UserResource($user),
        ], 201);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }

    // Задание 3: Выход на всех устройствах
    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->noContent();
    }
}