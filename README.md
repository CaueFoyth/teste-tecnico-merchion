# 📝 Teste Técnico Merchion

Este é um projeto desenvolvido para o teste técnico da empresa Merchion. Esse teste compõe três principais etapas: Teste teórico, onde é testado suas bases de conhecimento, diponibilizada no arquivo `teste_teorico.pdf`, contendo exemplos de código utilizados na pasta `exemplos_teoricos`. Segundo desafio foi desenvolver uma API RESTful para autenticação e gerenciamento de usuários, desenvolvida com Laravel 12. A terceira etapa foi desenvolver um front-end usando Nuxt para se comunicar com a API desenvolvida no passo anterior. 
O projeto foi estruturado seguindo as melhores práticas de desenvolvimento de software, com foco em segurança, manutenibilidade e escalabilidade.

---

## 🛠️ Tecnologias Utilizadas

* ⚙️ **Backend**: PHP 8.3+ / Laravel 12
* 📱 **Frontend**: TypeScript / Nuxt
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
git clone https://github.com/CaueFoyth/teste-tecnico-merchion.git
cd teste-tecnico-merchion
```
### 🛠️ Ambiente de Desenvolvimentos

Este ambiente é ideal para codificar, pois inclui hot-reloading, que atualiza a aplicação automaticamente conforme você altera o código.

### 1. Configure as Variáveis de Ambiente (DEV)

Copie o arquivo de exemplo para criar seu arquivo de configuração de desenvolvimento. O Docker Compose usará o arquivo .`env.local` por padrão neste ambiente.

```bash
cp .env.example .env.local
```
Ajuste as variáveis no arquivo `.env.local` conforme necessário para o seu ambiente local.

### 2. Inicie os Contêineres

Este comando irá construir e iniciar os contêineres usando o arquivo `docker-compose.dev.yml` padrão.

```bash
docker compose -f docker-compose.dev.yml up --build
```

### 3. Acessando a Aplicação
- **Frontend (Nuxt.js)**: http://localhost:3000
- **Backend (API Laravel)**: http://localhost:8000

---

### 📦 Ambiente de Produção

Este ambiente simula uma implantação real. Ele constrói imagens otimizadas, menores e mais seguras, sem as dependências de desenvolvimento e sem hot-reloading.

### 1. Configure as Variáveis de Ambiente (PROD)

Crie um arquivo de configuração específico para produção.

```bash
cp .env.example .env
```
**Importante**: Altere as variáveis no .env. para valores de produção (senhas fortes, URLs de domínio e etc.).

### 2. Inicie os Contêineres

Este comando irá construir e iniciar os contêineres usando o arquivo `docker-compose.dev.yml` padrão.

```bash
docker compose -f docker-compose.prod.yml up -d --build
```

### 3. Acessando a Aplicação
- **Frontend (Nuxt.js)**: http://localhost:3000
- **Backend (API Laravel)**: http://localhost:8000

---

## 📄 Documentação da API (Swagger)

A API possui uma documentação interativa gerada com Swagger (OpenAPI), que permite visualizar e testar todos os endpoints diretamente pelo navegador.

Acesse a documentação em: http://localhost:8000/api/documentation

## 🤖 Testando com o Postman

Para facilitar os testes dos endpoints, está disponibilizado uma coleção do Postman que pode ser importada.

1. **Localize o Ficheiro**: O arquivo `api-merchion.postman_collection.json` está na raiz deste repositório.
2. **Importe no Postman**:
    - Abra o Postman e vá a `File > Import...`
    - Selecione o ficheiro `api-merchion.postman_collection.json.`
3. Utilize: Uma nova coleção chamada "API Teste Técnico Merchion" aparecerá. Ela já contém as requisições para "Registrar Novo Usuário" e "Login de Usuário" pré-configuradas. A variável `{{base_url}}` já está definida como `http://localhost:8000`.

## 📌 Endpoints da API

### 1. 📝 Registrar Novo Usuário

* **URL**: `/api/register`
* **Método**: `POST`

**Corpo da Requisição (JSON)**:

```json
{
    "name": "Seu nome lindo",
    "email": "seu_melhor_email@email.com",
    "password": "uma_senha_forte"
}
```

**Resposta de Sucesso (201 Created)**:

```json
{
    "status": "success",
    "message": "Usuário registrado com sucesso!",
    "user": {
		"id": 1,
		"name": "Seu nome lindo",
		"email": "seu_melhor_email@email.com",
		"joined_at": "31/07/2025"
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
    "email": "seu_melhor_email@email.com",
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
		"name": "Seu nome lindo",
		"email": "seu_melhor_email@email.com",
		"joined_at": "31/07/2025"
	}
}
```
---

## 🧪 Testes Automatizados

Garantia de qualidade do código por meio de uma pipeline de testes automatizados, que valida as funcionalidades críticas da aplicação, como registro e login.

### 🔁 Execução Automática

Sempre que a aplicação é iniciada com o comando:

```bash
docker compose up
```

o pipeline realiza os seguintes passos automaticamente:

1. Aguarda o banco de dados estar pronto.
2. Garante a existência do arquivo `.env`.
3. Instala as dependências via Composer.
4. Gera a `APP_KEY` se necessário.
5. Executa as **migrations**.
6. **Roda os testes automatizados**.

> ⚠️ **Importante:** Se algum teste falhar, o serviço **não será iniciado**, garantindo que o ambiente não seja executado com erros.

### 🧾 Execução Manual

Você também pode rodar os testes manualmente a qualquer momento com o comando:

```bash
docker compose exec app php artisan test
```

Isso é útil durante o desenvolvimento, para validar funcionalidades específicas antes de subir alterações.

---

## 🧱 Decisões Arquiteturais no Backend

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

### 3. 🎨 Camada de Transformação com API Resources

* **Decisão**: Foi implementado o `UserResource` para atuar como uma camada de transformação entre os modelos Eloquent e as respostas JSON.
* **Justificativa**: Esta abordagem desacopla a estrutura da API da estrutura do banco de dados. Garante controle explícito sobre os campos expostos, evita o vazamento acidental de dados e oferece flexibilidade para formatar atributos ou adicionar dados de relacionamentos de forma limpa.

---

### 4. 🛡️ Segurança em Múltiplas Camadas

Decisão:

* 🔐 Criptografia automática de senha via `$casts`
* 🔒 Proteção com `$fillable` e `$hidden`
* 🚫 Prevenção de ataques via `throttle` e `session()->regenerate()`

Justificativa:
A segurança é tratada em todas as camadas, criando uma **defesa em profundidade**.

---

### 5. 🌐 Configuração de CORS para Aplicações SPA/Frontend

Decisão: O arquivo `config/cors.php` foi configurado para permitir origens específicas (ex: `http://localhost:3000`) com `'supports_credentials' => true`.

Justificativa:
Permitir o envio de **cookies** entre domínios é essencial para autenticação baseada em sessão.

## 📱 Frontend

### 🧱 Arquitetura Nuxt Escolhida

- SPA Mode - Ideal para autenticação e áreas protegidas
- Client-side rendering - Máxima interatividade
- Composables - Lógica reutilizável e bem organizada

### 📁 Estrutura Implementada:
- `/composables`: Lógica centralizada de auth
- `/middlewares`: Proteção de rotas e redirecionamento de usuários logados
- `/types`: Tipagem do User completa

### 📱 Páginas Implementadas
- `/` Página inicial com navegação
- `/register ` Formulário de cadastro
- `/register-success` Confirmação de cadastro
- `/login` Formulário de login
- `/dashboard` Área do usuário logado