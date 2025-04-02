<?php

namespace App\Domain\Factories;

use App\Domain\Entities\Pokemon;

interface PokemonEntityFactoryInterface
{
    public function create(
        int $id,
        string $name,
        int $weight,
        int $height,
        array $types
    ): Pokemon;
}
