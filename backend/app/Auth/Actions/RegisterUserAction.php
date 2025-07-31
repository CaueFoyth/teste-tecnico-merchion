<?php

namespace App\Auth\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterUserAction
{
    /**
     * Valida e cria um novo usuário.
     *
     * @param array $data Os dados do usuário (name, email, password).
     * @return User O usuário recém-criado.
     * @throws ValidationException
     */
    public function execute(array $data): User
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::defaults()],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return User::create($validator->validated());
    }
}