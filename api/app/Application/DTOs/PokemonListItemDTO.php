<?php

namespace App\Application\DTOs;

class PokemonListItemDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly array $types,
        public readonly float $weight,
        public readonly float $height,
    ) {}
}
