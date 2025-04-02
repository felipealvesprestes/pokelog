<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\PokemonResponseDTO;
use App\Application\DTOs\SearchPokemonRequestDTO;

interface SearchPokemonByNameUseCaseInterface
{
    public function execute(SearchPokemonRequestDTO $searchPokemonRequestDTO): ?PokemonResponseDTO;
}
