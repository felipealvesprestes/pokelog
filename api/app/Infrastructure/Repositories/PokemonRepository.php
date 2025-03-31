<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Pokemon;
use App\Domain\Repositories\PokemonRepositoryInterface;
use App\Infrastructure\Services\PokeApiService;

class PokemonRepository implements PokemonRepositoryInterface
{
    public function __construct(
        private PokeApiService $pokeApiService,
    ) {}

    public function getAllPaginated(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;

        $pokemonsData = $this->pokeApiService->get($perPage, $offset);
        $pokemons = [];

        foreach ($pokemonsData['results'] as $pokemon) {
            $details = $this->pokeApiService->getDetails($pokemon['url']);
            $pokemons[] = new Pokemon(
                $details['id'],
                $details['name'],
                $details['types'],
                $details['weight'],
                $details['height'],
            );
        }

        return [
            'pokemons' => $pokemons,
            'total' => $pokemonsData['count'] ?? count($pokemons)
        ];
    }
}
