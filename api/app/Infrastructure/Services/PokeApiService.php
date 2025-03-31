<?php

namespace App\Infrastructure\Services;

use Illuminate\Support\Facades\Http;

class PokeApiService
{
    private string $baseUrl = 'https://pokeapi.co/api/v2/';

    public function get(int $limit = 10, int $offset = 0)
    {
        $response = Http::get($this->baseUrl . '/pokemon', [
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $response->json();
    }

    public function getDetails(string $url)
    {
        return Http::get($url)->json();
    }
}
