<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\PokemonsResponseDTO;

interface PokemonsResponseDTOFactoryInterface
{
    public function create(array $pokemons = [], int $total = 0, int $page = 1, int $perPage = 10): PokemonsResponseDTO;
}
