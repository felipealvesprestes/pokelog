<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\PokemonListItemDTO;

interface PokemonListItemDTOFactoryInterface
{
    public function create(array $pokemonData): PokemonListItemDTO;
}
