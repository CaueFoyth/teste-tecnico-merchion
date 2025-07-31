<?php

namespace App\Http\Controllers\API;

use App\Auth\Actions\LoginUserAction;
use App\Auth\Actions\RegisterUserAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request, RegisterUserAction $registerUserAction): JsonResponse
    {
        try {
            $user = $registerUserAction->execute($request->only('name', 'email', 'password'));

            return response()->json([
                'status' => 'success',
                'message' => 'Usuário registrado com sucesso!',
                'user' => $user,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro de validação.',
                'errors' => $e->errors(),
            ], 422);
        }
    }


    public function login(Request $request, LoginUserAction $loginUserAction): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro de validação.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $loginUserAction->execute($validator->validated());

            $request->session()->regenerate();

            return response()->json([
                'status' => 'success',
                'message' => 'Login realizado com sucesso.',
                'user' => Auth::user(),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'As credenciais fornecidas estão incorretas.',
                'errors' => $e->errors(),
            ], 401);
        }
    }
}