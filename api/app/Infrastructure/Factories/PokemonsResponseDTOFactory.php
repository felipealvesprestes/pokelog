<?php

namespace App\Infrastructure\Factories;

use App\Application\DTOs\PokemonsResponseDTO;
use App\Application\Interfaces\PokemonsResponseDTOFactoryInterface;

class PokemonsResponseDTOFactory implements PokemonsResponseDTOFactoryInterface
{
    public function create(array $pokemons = [], int $total = 0, int $page = 1, int $perPage = 0): PokemonsResponseDTO
    {
        return new PokemonsResponseDTO(
            pokemons: $pokemons,
            total: $total,
            page: $page,
            perPage: $perPage
        );
    }
}
