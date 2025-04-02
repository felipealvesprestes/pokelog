<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Pokemon;
use App\Domain\Factories\PokemonEntityFactoryInterface;
use App\Domain\Repositories\PokemonRepositoryInterface;
use App\Infrastructure\Services\PokeApiService;

class PokemonRepository implements PokemonRepositoryInterface
{
    public function __construct(
        private PokeApiService $pokeApiService,
        private PokemonEntityFactoryInterface $pokemonEntityFactoryInterface,
    ) {}

    public function getAll(): array
    {
        // usado 20 pokemons para não pesar a requisição
        $response = $this->pokeApiService->get(20, 0);

        $pokemons = [];

        foreach ($response['results'] as $pokemon) {
            $details = $this->pokeApiService->getDetails($pokemon['url']);
            $pokemons[] = $this->pokemonEntityFactory($details);
        }

        return $pokemons;
    }

    public function getAllPaginated(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;

        $pokemonsData = $this->pokeApiService->get($perPage, $offset);
        $pokemons = [];

        foreach ($pokemonsData['results'] as $pokemon) {
            $details = $this->pokeApiService->getDetails($pokemon['url']);
            $pokemons[] = $this->pokemonEntityFactory($details);
        }

        return [
            'pokemons' => $pokemons,
            'total' => $pokemonsData['count'] ?? count($pokemons)
        ];
    }

    public function getByName(?string $name = null): ?Pokemon
    {
        if (!$name) {
            return null;
        }

        $response = $this->pokeApiService->getByName($name);

        if ($response) {
            return $this->pokemonEntityFactory($response);
        }

        return null;
    }

    public function getByType(?string $type = null): array
    {
        if (!$type) {
            return [];
        }

        $response = $this->pokeApiService->getByType($type);

        if (!isset($response['pokemon'])) {
            return [];
        }

        $pokemons = [];

        foreach ($response['pokemon'] as $pokemon) {
            $details = $this->pokeApiService->getByName($pokemon);
            $pokemons[] = $this->pokemonEntityFactory($details);
        }

        return $pokemons;
    }

    private function pokemonEntityFactory(array $detailsPokemon): Pokemon
    {
        return $this->pokemonEntityFactoryInterface->create(
            id: $detailsPokemon['id'],
            name: $detailsPokemon['name'],
            weight: $detailsPokemon['weight'],
            height: $detailsPokemon['height'],
            types: $detailsPokemon['types'],
        );
    }
}
