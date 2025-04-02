<?php

namespace App\Infrastructure\Factories;

use App\Application\DTOs\SearchPokemonRequestDTO;
use App\Application\Interfaces\SearchPokemonRequestDTOFactoryInterface;

class SearchPokemonRequestDTOFactory implements SearchPokemonRequestDTOFactoryInterface
{
    public function create(array $pokemonRequest): SearchPokemonRequestDTO
    {
        return new SearchPokemonRequestDTO(
            $pokemonRequest['name'] ?? null,
            $pokemonRequest['type'] ?? null,
        );
    }
}
