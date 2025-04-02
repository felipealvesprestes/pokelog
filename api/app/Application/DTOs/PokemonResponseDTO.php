<?php

namespace App\Application\DTOs;

use App\Application\Traits\ToArrayable;

class PokemonResponseDTO
{
    use ToArrayable;

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly float $weight,
        public readonly float $height,
        public readonly array $types
    ) {}
}
