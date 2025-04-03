# Documentação da API

## Visão Geral
Esta é a API construída usando Laravel 12 consumindo a PokeApi.

## Requisitos
- PHP >= 8.1
- Composer

## Instalação

1. Clone o repositório:
    ```bash
    git clone git@github.com:felipealvesprestes/pokelog.git
    cd pokelog/api
    ```

2. Instale as dependências:
    ```bash
    composer install
    ```

3. Configure o ambiente:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure o arquivo `.env` com as configurações do seu banco de dados e outras definições.

5. Execute as migrations:
    ```bash
    php artisan migrate
    ```

6. Inicie o servidor de desenvolvimento:
    ```bash
    ./vendor/bin/sail up ou docker compose up
    ```

## Popular banco de dados

1. Popule o banco de dados com os dados da PokeAPI:

    ```bash
    ./vendor/bin/sail php artisan app:sync-pokemon-data
    ```

## Endpoints
- localhost/api/pokemons
- localhost/api/pokemons?page=1&perPage=10
- localhost/api/pokemons/search?type=fire
- localhost/api/pokemons/search?name=pikachu
- localhost/api/pokemons/1
