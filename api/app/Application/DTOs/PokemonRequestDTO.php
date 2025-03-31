<?php

namespace App\Application\DTOs;

class PokemonRequestDTO
{
    public function __construct(
        public readonly int $page,
        public readonly int $perPage,
    ) {}
}
