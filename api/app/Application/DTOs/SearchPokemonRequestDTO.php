<?php

namespace App\Application\DTOs;

class SearchPokemonRequestDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $type,
    ) {}
}
