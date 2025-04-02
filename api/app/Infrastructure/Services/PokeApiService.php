<?php

namespace App\Infrastructure\Services;

use Illuminate\Support\Facades\Http;

class PokeApiService
{
    private string $baseUrl = 'https://pokeapi.co/api/v2/';

    public function get(int $limit = 10000, int $offset = 0)
    {
        $response = Http::get($this->baseUrl . '/pokemon', [
            'limit' => $limit,
            'offset' => $offset,
        ]);

        $pokemons = $response->json()['results'];

        foreach ($pokemons as &$pokemon) {
            $pokemonDetails = $this->getDetails($pokemon['url']);
            $pokemon['types'] = $pokemonDetails['types'] ?? [];
        }

        return [
            'count' => $response->json()['count'],
            'results' => $pokemons,
        ];
    }

    public function getDetails(string $url)
    {
        $response = Http::get($url)->json();

        if (isset($response['types'])) {
            $response['types'] = array_map(fn($type) => $type['type']['name'], $response['types']);
        }

        return $response;
    }

    public function getByName(string $name)
    {
        $response = Http::get($this->baseUrl . '/pokemon/' . $name);

        if ($response->failed()) {
            return null;
        }

        $data = $response->json();

        if (isset($data['types'])) {
            $data['types'] = array_map(fn($type) => $type['type']['name'], $data['types']);
        }

        return $data;
    }

    public function getByType(string $type)
    {
        $response = Http::get($this->baseUrl . '/type/' . $type);

        if ($response->failed()) {
            return null;
        }

        $data = $response->json();

        if (isset($data['pokemon'])) {
            $data['pokemon'] = array_map(fn($pokemon) => $pokemon['pokemon']['name'], $data['pokemon']);
        }

        return $data;
    }
}
