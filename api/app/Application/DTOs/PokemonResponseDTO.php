<?php

namespace App\Application\DTOs;

use App\Application\Traits\ToArrayable;

class PokemonResponseDTO
{
    use ToArrayable;

    public function __construct(
        public readonly array $pokemons = [],
        public readonly int $total = 0,
        public readonly int $page = 0,
        public readonly int $perPage = 0,
    ) {}
}
