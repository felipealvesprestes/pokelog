<?php

namespace App\Infrastructure\Factories;

use App\Application\DTOs\PokemonListItemDTO;
use App\Application\Interfaces\PokemonListItemDTOFactoryInterface;

class PokemonListItemDTOFactory implements PokemonListItemDTOFactoryInterface
{
    public function create(array $pokemonData): PokemonListItemDTO
    {
        return new PokemonListItemDTO(
            id: $pokemonData['id'],
            name: $pokemonData['name'],
            types: $pokemonData['types'],
            weight: $pokemonData['weight'],
            height: $pokemonData['height']
        );
    }
}
