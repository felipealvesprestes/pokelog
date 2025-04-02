<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\PokemonResponseDTO;

interface PokemonResponseDTOFactoryInterface
{
    public function create(
        int $id,
        string $name,
        float $weight,
        float $height,
        array $types
    ): PokemonResponseDTO;
}
