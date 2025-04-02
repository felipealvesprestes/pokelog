<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\SearchPokemonRequestDTO;

interface SearchPokemonRequestDTOFactoryInterface
{
    public function create(array $request): SearchPokemonRequestDTO;
}
