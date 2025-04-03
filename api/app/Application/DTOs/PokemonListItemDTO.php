<?php

namespace App\Application\DTOs;

use App\Application\Traits\ToArrayable;

class PokemonListItemDTO
{
    use ToArrayable;

    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly array $types,
        public readonly float $weight,
        public readonly float $height,
    ) {}
}
