<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\PokemonRequestDTO;

interface PokemonRequestDTOFactoryInterface
{
    public function create(array $pokemonRequest): PokemonRequestDTO;
}
