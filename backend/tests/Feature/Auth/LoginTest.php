<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_should_log_in_a_user_successfully_and_start_a_session(): void
    {
        // Arrange: Criamos um usuário para podermos fazer login com ele.
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password123', // O model irá criptografar isso
        ]);

        $credentials = [
            'email' => 'test@example.com',
            'password' => 'password123', // A senha em texto plano para a requisição
        ];

        // Act: Fazemos a requisição para o endpoint de login.
        $response = $this->postJson('/api/login', $credentials);

        // Assert: Verificamos a resposta e o estado da aplicação.
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                ],
            ]);

        // Assertiva mais importante: verificamos se o usuário está de fato autenticado na sessão.
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function it_should_fail_with_incorrect_credentials(): void
    {
        // Arrange: Criamos um usuário.
        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $wrongCredentials = [
            'email' => 'test@example.com',
            'password' => 'wrong-password', // Senha incorreta
        ];

        // Act: Tentamos fazer login com a senha errada.
        $response = $this->postJson('/api/login', $wrongCredentials);

        // Assert:
        $response
            ->assertStatus(401) // Esperamos um erro 401 Unauthorized.
            ->assertJson([
                'status' => 'error',
                'message' => 'As credenciais fornecidas estão incorretas.',
            ]);

        // Garantimos que nenhum usuário foi autenticado.
        $this->assertGuest();
    }

    #[Test]
    public function it_should_return_a_validation_error_if_password_is_missing(): void
    {
        // Arrange
        $credentials = [
            'email' => 'test@example.com',
            // 'password' => '...' // Campo da senha ausente
        ];

        // Act
        $response = $this->postJson('/api/login', $credentials);

        // Assert
        $response
            ->assertStatus(422) // Esperamos um erro de validação 422.
            ->assertJsonValidationErrors(['password']); // A resposta deve indicar um erro no campo 'password'.
    }
}