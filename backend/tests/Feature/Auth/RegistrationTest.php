<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_should_register_a_new_user_successfully(): void
    {
        // Arrange: Preparamos os dados de um usuário válido.
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'Password123!',
        ];

        // Act: Fazemos uma requisição POST para o endpoint de registro.
        $response = $this->postJson('/api/register', $userData);

        // Assert: Verificamos se tudo ocorreu como esperado.
        $response
            ->assertStatus(201) // 1. O status HTTP deve ser 201 Created.
            ->assertJson([      // 2. A resposta JSON deve ter a estrutura esperada.
                'status' => 'success',
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                ],
            ]);

        // 3. Verificamos se o usuário realmente existe no banco de dados.
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);

        // 4. Verificamos se a senha foi salva CRIPTOGRAFADA, e não em texto plano.
        $user = User::first();
        $this->assertNotEquals('Password123!', $user->password);
    }

    #[Test]
    public function it_should_return_a_validation_error_if_email_already_exists(): void
    {
        // Arrange: Criamos um usuário primeiro para que o e-mail já exista.
        User::factory()->create(['email' => 'jane.doe@example.com']);

        $newUserData = [
            'name' => 'Jane Smith',
            'email' => 'jane.doe@example.com', // E-mail repetido
            'password' => 'Password123!',
        ];

        // Act: Tentamos registrar um novo usuário com o mesmo e-mail.
        $response = $this->postJson('/api/register', $newUserData);

        // Assert: Verificamos se a API retornou o erro de validação correto.
        $response
            ->assertStatus(422) // 1. O status HTTP deve ser 422 Unprocessable Entity.
            ->assertJsonValidationErrors(['email']); // 2. A resposta deve indicar um erro no campo 'email'.

        // 3. Garantimos que nenhum novo usuário foi criado.
        $this->assertDatabaseCount('users', 1);
    }
}