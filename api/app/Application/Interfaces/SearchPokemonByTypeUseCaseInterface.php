<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\PokemonsResponseDTO;
use App\Application\DTOs\SearchPokemonRequestDTO;

interface SearchPokemonByTypeUseCaseInterface
{
    public function execute(SearchPokemonRequestDTO $searchPokemonRequestDTO): ?PokemonsResponseDTO;
}
