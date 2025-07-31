<?php

namespace Tests\Unit\Auth\Actions;

use App\Auth\Actions\RegisterUserAction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

// Convertemos o teste para uma classe que estende TestCase
class RegisterUserActionTest extends TestCase
{
    // O trait RefreshDatabase é importado aqui dentro da classe
    use RefreshDatabase;

    /**
     * Testa se o método execute cria e retorna um usuário com sucesso.
     * O nome do método começa com "test" para ser reconhecido pelo PHPUnit.
     * @test
     */
    public function execute_method_creates_and_returns_a_user(): void
    {
        // Arrange: Instanciamos a nossa Action diretamente.
        $action = new RegisterUserAction();
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Password123!',
        ];

        // Act: Executamos o método `execute` diretamente.
        $resultUser = $action->execute($userData);

        // Assert: Verificamos o resultado.
        // 1. O resultado deve ser uma instância da classe User.
        $this->assertInstanceOf(User::class, $resultUser);

        // 2. O e-mail do usuário retornado deve ser o correto.
        $this->assertEquals('test@example.com', $resultUser->email);

        // 3. O usuário deve existir no banco de dados.
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    /**
     * Testa se o método execute lança uma exceção com dados inválidos.
     * @test
     */
    public function execute_method_throws_validation_exception_for_invalid_data(): void
    {
        // Arrange
        $action = new RegisterUserAction();
        $invalidData = [
            'name' => 'Test',
            'email' => 'not-an-email', // E-mail inválido
            'password' => '123',      // Senha curta
        ];

        // Assert: Esperamos que uma exceção específica seja lançada.
        $this->expectException(ValidationException::class);

        // Act: Executamos o método que deve causar a exceção.
        $action->execute($invalidData);
    }
}