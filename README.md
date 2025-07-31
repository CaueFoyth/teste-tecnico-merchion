Claro! Aqui está seu conteúdo com emojis adicionados para deixá-lo mais agradável visualmente no README, **sem alterar os textos originais**:

---

# 🔐 API de Autenticação - Teste Técnico

Esta é uma API RESTful para autenticação e gerenciamento de usuários, desenvolvida com Laravel 11. O projeto foi estruturado seguindo as melhores práticas de desenvolvimento de software, com foco em segurança, manutenibilidade e escalabilidade.

---

## 🛠️ Tecnologias Utilizadas

* ⚙️ **Backend**: PHP 8.3+ / Laravel 11
* 🗄️ **Banco de Dados**: MySQL 8+
* 🐳 **Ambiente de Desenvolvimento**: Docker / Docker Compose

---

## 🚀 Instalação e Execução

Para executar este projeto localmente, siga os passos abaixo.

### ✅ Pré-requisitos

* 🐳 Docker
* 📦 Docker Compose

### 📋 Passos

**Clone o repositório**:

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

**Configure as variáveis de ambiente**:
Copie o arquivo de exemplo `.env.example` para criar seu próprio arquivo de configuração `.env`.

```bash
cp .env.example .env
```

Certifique-se de que as credenciais do banco de dados no arquivo `.env` (`DB_HOST`, `DB_PORT`, etc.) correspondem à configuração do seu `docker-compose.yml`.

**Inicie os contêineres Docker**:
Este comando irá construir e iniciar os contêineres da aplicação PHP, do servidor web Nginx e do banco de dados MySQL.

```bash
docker-compose up -d --build
```

**Instale as dependências do Composer**:

```bash
docker-compose exec app composer install
```

**Gere a chave da aplicação**:

```bash
docker-compose exec app php artisan key:generate
```

**Execute as migrations do banco de dados**:
Este comando criará as tabelas `users`, `sessions`, etc., no banco de dados.

```bash
docker-compose exec app php artisan migrate
```

📡 A API estará disponível em [http://localhost:8000](http://localhost:8000) (ou na porta que você configurou).

---

## 📌 Endpoints da API

### 1. 📝 Registrar Novo Usuário

* **URL**: `/api/register`
* **Método**: `POST`

**Corpo da Requisição (JSON)**:

```json
{
    "name": "Nome do Usuário",
    "email": "usuario@exemplo.com",
    "password": "uma_senha_forte"
}
```

**Resposta de Sucesso (201 Created)**:

```json
{
    "status": "success",
    "message": "Usuário registrado com sucesso!",
    "user": {
        "name": "Nome do Usuário",
        "email": "usuario@exemplo.com",
        "updated_at": "2024-07-31T13:00:00.000000Z",
        "created_at": "2024-07-31T13:00:00.000000Z",
        "id": 1
    }
}
```

---

### 2. 🔐 Login de Usuário

* **URL**: `/api/login`
* **Método**: `POST`

**Corpo da Requisição (JSON)**:

```json
{
    "email": "usuario@exemplo.com",
    "password": "uma_senha_forte"
}
```

**Resposta de Sucesso (200 OK)**:

```json
{
    "status": "success",
    "message": "Login realizado com sucesso.",
    "user": {
        "id": 1,
        "name": "Nome do Usuário",
        "email": "usuario@exemplo.com",
        "email_verified_at": null,
        "created_at": "2024-07-31T13:00:00.000000Z",
        "updated_at": "2024-07-31T13:00:00.000000Z"
    }
}
```
---

## 🧪 Testes Automatizados

A qualidade do código é garantida por uma suíte de testes automatizados que cobrem as funcionalidades críticas da aplicação (registro e login). Utilizamos o framework de testes Pest/PHPUnit, integrado ao Laravel.

### Executando os Testes

* **Execução Automática**: Os testes são executados automaticamente toda vez que a aplicação é iniciada com `docker-compose up`. Se algum teste falhar, o serviço da aplicação não será iniciado, garantindo a integridade do ambiente.

* **Execução Manual**: Para rodar os testes manualmente a qualquer momento, execute o seguinte comando:
  ```bash
  docker compose exec app php artisan test
  ```

---

## 🧱 Decisões Arquiteturais

A arquitetura deste projeto foi pensada para criar uma base de código limpa, segura e fácil de manter, especialmente para uma API.

---

### 1. 🧼 Arquitetura de API Enxuta

Decisão: Foram removidos os arquivos de views, assets (CSS/JS) e as rotas do arquivo `web.php`.

Justificativa: Isso reduz a complexidade do projeto, diminui a superfície de ataque e deixa claro que o único propósito desta aplicação é servir uma API, alinhando o código à sua real finalidade.

---

### 2. 🧩 Padrão de Arquitetura "Action Pattern"

Decisão: A lógica de registro e login foi movida do `AuthController` para as classes `App\Auth\Actions\RegisterUserAction` e `App\Auth\Actions\LoginUserAction`.

Justificativa:

* 🧠 **SRP** (Princípio da Responsabilidade Única): Cada classe tem um propósito único.
* ✨ **Controladores Enxutos**: Mais legíveis e organizados.
* 🧪 **Testabilidade**: Facilita testes unitários para cada ação.

---

### 3. 🛡️ Segurança em Múltiplas Camadas

Decisão:

* 🔐 Criptografia automática de senha via `$casts`
* 🔒 Proteção com `$fillable` e `$hidden`
* 🚫 Prevenção de ataques via `throttle` e `session()->regenerate()`

Justificativa:
A segurança é tratada em todas as camadas, criando uma **defesa em profundidade**.

---

### 4. 🌐 Configuração de CORS para Aplicações SPA/Frontend

Decisão: O arquivo `config/cors.php` foi configurado para permitir origens específicas (ex: `http://localhost:3000`) com `'supports_credentials' => true`.

Justificativa:
Permitir o envio de **cookies** entre domínios é essencial para autenticação baseada em sessão.