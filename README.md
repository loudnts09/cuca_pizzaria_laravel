# Pizzaria do Cuca

Um sistema de gerenciamento para uma pizzaria, desenvolvido com Laravel 7, com foco em simplicidade e funcionalidade.

O projeto "Pizzaria do Cuca" é um sistema de gerenciamento que permite gerenciar usuários, pedidos e perfis. Ele foi desenvolvido como um CRUD simples para por em prática conhecimentos sobre o framework Laravel.

## Tecnologias utilizadas

- Linguagem: PHP 7
- Framework: Laravel 7
- Banco de dados: MySQL
- Frontend: Bootstrap 4, HTML5, CSS3

## Instalação

1. Clone o repositório:

    ```sh
    git clone https://github.com/loudnts09/cuca_pizzaria_laravel.git
    cd pizzaria_do_cuca
    ```

2. Instale as dependências do Composer:

    ```sh
    composer install
    ```

3. Copie o arquivo `.env.example` para [.env](http://_vscodecontentref_/1) e configure suas variáveis de ambiente:

    ```sh
    cp .env.example .env
    ```

4. Gere a chave da aplicação:

    ```sh
    php artisan key:generate
    ```

5. Configure o banco de dados no arquivo [.env](http://_vscodecontentref_/2):

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pizzaria_do_cuca
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

6. Em seu arquivo php.ini habilite as seguintes extensões:

    ```sh
    extension=openssl
    extension=curl
    extension=pdo_mysql
    extension=mbstring
    extension=mysqli
    extension=fileinfo
    ```

7. Execute as migrações para criar as tabelas:

    ```sh
    php artisan migrate
    ```

8. Inicie o servidor de desenvolvimento:

    ```sh
    php artisan serve
    ```

9. Acesse a aplicação em [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Funcionalidades

- **Autenticação de Usuários**: Registro, login e logout.
- **Gerenciamento de Pedidos**: Criação, visualização, edição e exclusão de pedidos.
- **Perfil do Usuário**: Visualização, exclusão e atualização das informações do perfil, incluindo foto de perfil.
- **Administração**: Gerenciamento de pedidos.
