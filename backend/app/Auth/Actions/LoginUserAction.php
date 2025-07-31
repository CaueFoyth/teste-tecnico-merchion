<?php

namespace App\Auth\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginUserAction
{
    /**
     * Valida as credenciais e tenta autenticar o usuário.
     *
     * @param array $credentials As credenciais (email, password).
     * @return bool Retorna true se o login for bem-sucedido.
     * @throws ValidationException
     */
    public function execute(array $credentials): bool
    {
        $validator = Validator::make($credentials, [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        if (!Auth::attempt($validator->validated())) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        return true;
    }
}