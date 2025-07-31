<?php

namespace App\Http\Controllers\API;

use App\Auth\Actions\LoginUserAction;
use App\Auth\Actions\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * @OA\Info(
 * version="1.0.0",
 * title="API de Autenticação para Teste Técnico Merchion",
 * description="Documentação da API para registro e login de usuários."
 * )
 * @OA\Server(
 * url=L5_SWAGGER_CONST_HOST,
 * description="Servidor da API"
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/register",
     * summary="Registra um novo usuário",
     * tags={"Autenticação"},
     * @OA\RequestBody(
     * required=true,
     * description="Dados do novo usuário",
     * @OA\JsonContent(
     * required={"name","email","password"},
     * @OA\Property(property="name", type="string", example="Seu nome lindo"),
     * @OA\Property(property="email", type="string", format="email", example="seu_melhor_email@email.com"),
     * @OA\Property(property="password", type="string", format="password", example="uma_senha_forte")
     * ),
     * ),
     * @OA\Response(
     * response=201,
     * description="Usuário registrado com sucesso",
     * @OA\JsonContent(
     * @OA\Property(property="status", type="string", example="success"),
     * @OA\Property(property="message", type="string", example="Usuário registrado com sucesso!"),
     * @OA\Property(property="user", ref="#/components/schemas/UserResource")
     * )
     * ),
     * @OA\Response(
     * response=422,
     * description="Erro de validação"
     * )
     * )
     */
    public function register(Request $request, RegisterUserAction $registerUserAction): JsonResponse
    {
        try {
            $user = $registerUserAction->execute($request->only('name', 'email', 'password'));

            return response()->json([
                'status' => 'success',
                'message' => 'Usuário registrado com sucesso!',
                'user' => new UserResource($user),
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro de validação.',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * @OA\Post(
     * path="/api/login",
     * summary="Realiza o login do usuário e inicia uma sessão",
     * tags={"Autenticação"},
     * @OA\RequestBody(
     * required=true,
     * description="Credenciais do usuário",
     * @OA\JsonContent(
     * required={"email","password"},
     * @OA\Property(property="email", type="string", format="email", example="seu_melhor_email@email.com"),
     * @OA\Property(property="password", type="string", format="password", example="uma_senha_forte")
     * ),
     * ),
     * @OA\Response(
     * response=200,
     * description="Login bem-sucedido",
     * @OA\JsonContent(
     * @OA\Property(property="status", type="string", example="success"),
     * @OA\Property(property="message", type="string", example="Login realizado com sucesso."),
     * @OA\Property(property="user", ref="#/components/schemas/UserResource")
     * )
     * ),
     * @OA\Response(
     * response=401,
     * description="Credenciais inválidas"
     * )
     * )
     */
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
                'user' => new UserResource(Auth::user()),
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