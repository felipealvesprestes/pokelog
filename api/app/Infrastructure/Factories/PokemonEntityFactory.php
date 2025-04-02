<?php

namespace App\Infrastructure\Factories;

use App\Domain\Entities\Pokemon;
use App\Domain\Factories\PokemonEntityFactoryInterface;

class PokemonEntityFactory implements PokemonEntityFactoryInterface
{
    public function create(
        int $id,
        string $name,
        int $weight,
        int $height,
        array $types
    ): Pokemon {
        return new Pokemon(
            id: $id,
            name: $name,
            weight: $weight,
            height: $height,
            types: $types
        );
    }
}
