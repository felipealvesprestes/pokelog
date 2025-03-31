<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\PokemonRequestDTO;
use App\Application\DTOs\PokemonResponseDTO;

interface ListPokemonUseCaseInterface
{
    public function execute(PokemonRequestDTO $pokemonDTO): PokemonResponseDTO;
}
