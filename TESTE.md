# Desenvolvedor Fullstack Pleno - Teste técnico

## Olá, candidato(a)!

Obrigado pelo seu interesse em fazer parte do nosso time na Merchion. Ficamos muito felizes em ver seu entusiasmo e dedicação. Este teste técnico foi preparado para avaliar não apenas seu conhecimento em TypeScript, PHP e Orientação a Objetos, mas também para dar a você uma pequena amostra de como trabalhamos e colaboramos em equipe.

Fique à vontade para nos enviar quaisquer dúvidas durante o processo. Boa sorte e desejamos uma ótima experiência realizando o desafio!

## **Parte 1: Questões Teóricas**

### 1. **Orientação a Objetos (OOP)**

a. Explique os **quatro pilares** da Orientação a Objetos. Dê exemplos práticos de cada pilar (mesmo que breves) para demonstrar entendimento.

b. Em PHP, como você aplica esses princípios ao construir uma classe de domínio (por exemplo, `Produto` ou `Pedido`)?

### 2. **TypeScript**

a. Quais as vantagens de se usar **TypeScript** em projetos Vue (ou JavaScript em geral)?

b. Explique a diferença entre **tipagem estática** e **tipagem dinâmica** no contexto de TypeScript e JavaScript.

### 3. **PHP**

a. **Autoloading e Composer**: O que é autoloading no PHP? Explique como o Composer facilita esse processo e por que esse recurso é fundamental em projetos de médio e grande porte.

b. **Tratamento de Exceções**: Como você lida com exceções em PHP? Dê exemplos de como criar suas próprias exceções personalizadas e explique quando isso é benéfico.

c. **PSRs (PHP Standards Recommendations)**: Cite duas ou três PSRs que você considera importantes no dia a dia de um projeto PHP e por que elas são relevantes.

### 4. **Integração com Frameworks**

a. Explique a diferença entre **SSR (Server-Side Rendering)**, **SSG (Static Site Generation)** e **SPA (Single Page Application).**

b. **Laravel**: Explique detalhadamente o ciclo de vida de uma requisição HTTP no Laravel, desde o momento em que a requisição chega ao servidor até a resposta ser enviada ao cliente. Destaque os principais componentes do framework envolvidos nesse processo e explique o papel de cada um (por exemplo: middleware, roteamento, controllers, service providers, etc).

<aside>
⚠️

**IMPORTANTE: As questões teóricas respondidas devem ser enviadas, juntamente com o link do repositório do teste prático para o email:** [ti@merchion.tech](mailto:ti@merchion.tech) ****

</aside>

---

## **Parte 2: Desafio Prático VueJS + PHP**

- **Backend** (Utilize a versão mais recente do Laravel):
    - Crie uma **API** para gerenciar os usuários, contemplando:
        - Cadastro de novo usuário (nome, email, senha, criado_em).
        - Login de usuário.
    - Ao cadastrar, **criptografe** a senha e salve-a no banco de dados.
    - Ao fazer login, valide o usuário e **crie** uma sessão que armazene as informações do usuário **(exceto a senha)**.
    - Utilize **MySQL** como banco de dados e o **Eloquent ORM**:
        - Crie os **Models** necessários.
        - Utilize **Migrations** para criar as tabelas.
- **Frontend** (Vue.js + TypeScript):
    - Crie uma **mini-aplicação** em Vue.js ou NuxtJS, usando **TypeScript**.
    - Utilize **componentes** para organizar o layout. Você pode usar **qualquer biblioteca** **CSS** (Bootstrap, Tailwind, etc.) ou criar seu próprio estilo.
    - Tenha, ao menos, as seguintes telas:
        1. **Cadastro** (formulário)
            - Envia nome, email e senha para a API de cadastro.
            - Ao concluir o cadastro com sucesso, levar o usuário a uma **página de “Parabéns”** ou confirmação (pode ser algo simples).
        2. **Login** (formulário)
            - Envia email e senha para a API de login.
            - Se as credenciais estiverem corretas, armazenar em sessão do lado do **backend** e retornar uma resposta de sucesso no frontend.
            - Ao fazer login com sucesso, redirecionar para uma página que exibe um texto dizendo que o usuário está logado (por exemplo, “Bem-vindo, Fulano!”).
        3. **Página do Usuário Logado**
            - Ao acessar essa rota (depois do login), exibir uma mensagem de que o usuário está logado.
            - Não é necessário implementar proteção de rota complexa no frontend (ex.: JWT ou algo assim), mas, se quiser, pode ao menos verificar se houve sucesso no login via algum state local ou cookie.
- **Integração e Arquitetura**:
    - No **frontend**, crie uma camada de integração (por exemplo, uma pasta `services/` ou `api/`) para lidar com as chamadas HTTP (fetch/axios).
    - Trate **CORS** adequadamente no backend para permitir que o frontend em outro domínio/porta consiga acessar os endpoints.
    - Mantenha uma **estrutura de pastas** clara e componentes bem organizados:
        - `components/` para componentes Vue.
        - `views/` ou `pages/` para telas maiores (se preferir uma convenção nesse sentido).
        - `services/` ou `api/` para chamadas à API.
        - `models/` (opcional) para tipos/interfaces em TypeScript que representam seu domínio (ex.: `User`).
- **Sessão e Segurança**:
    - Ao fazer login, **armazene** na sessão apenas dados pertinentes do usuário (por exemplo, `id`, `nome`, `email`).
    - **Não armazene a senha** ou hash da senha na sessão.
    - Utilize o padrão do Laravel para implementação da autenticação e gestão de sessões (Guards e Providers).
- **Entrega**:
    - Disponibilize o **código** completo em um repositório público (GitHub, GitLab, Bitbucket etc.).
    - Inclua instruções **README** para rodar tanto o backend quanto o frontend:
        - Como instalar dependências (`composer install` para o Backend em PHP, `npm install` ou `yarn` para o Vue).
        - Como configurar o banco de dados (env vars, `.env`, `.env.local`), rodar migrations e iniciar o servidor que irá rodar o backend em Laravel (PHP).
        - Como iniciar o servidor local do Vue (`npm run dev`, `yarn dev`, etc.).
    - Caso queira demonstrar seu domínio de **boas práticas**, inclua breves explicações de decisões arquiteturais (ex.: “porque escolhi essa estrutura de pastas no Vue” ou “como configurei o CORS no Laravel”).
    - Por fim, opcionalmente, mas será muito bem visto, se apresentar uma collection em formato JSON para Postman, para testar os endpoints da API.

## **Conclusão**

Esse teste avalia:

- **Organização do Projeto**: Estrutura de pastas, clareza e separação de responsabilidades.
- **Domínio de Laravel (PHP)**: Models, uso do Eloquent, Sessões com Guards/Providers ou mesmo templates prontos para autenticação e gestão de sessões.
- **Domínio de Vue.js + TypeScript**: Componetização, tipagem, boas práticas de reatividade e configuração.
- **Boas Práticas de Código**: Nomenclatura, ausência de duplicações, tratamento de erros.
- **Documentação Básica**: Instruções para rodar o projeto e explicações relevantes.

<aside>
⚠️

**IMPORTANTE: As questões teóricas respondidas devem ser enviadas juntamente com o link do repositório do teste prático para o email:** [ti@merchion.tech](mailto:ti@merchion.tech) ****

</aside>

## Prazo para entrega do teste técnico (teoria e prática):

A entrega do teste técnico completo (teoria e prática) deve acontecer até o **dia 04/08/2025 (Segunda-feira) às 12h**.