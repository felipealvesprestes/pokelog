<?php

namespace App\Infrastructure\Factories;

use App\Application\DTOs\PokemonRequestDTO;
use App\Application\Interfaces\PokemonRequestDTOFactoryInterface;

class PokemonRequestDTOFactory implements PokemonRequestDTOFactoryInterface
{
    public function create(array $pokemonRequest): PokemonRequestDTO
    {
        return new PokemonRequestDTO(
            page: $pokemonRequest['page'],
            perPage: $pokemonRequest['perPage'],
        );
    }
}
