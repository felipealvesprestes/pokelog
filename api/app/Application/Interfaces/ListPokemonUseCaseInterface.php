<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\PokemonRequestDTO;
use App\Application\DTOs\PokemonsResponseDTO;

interface ListPokemonUseCaseInterface
{
    public function execute(PokemonRequestDTO $pokemonDTO): PokemonsResponseDTO;
}
