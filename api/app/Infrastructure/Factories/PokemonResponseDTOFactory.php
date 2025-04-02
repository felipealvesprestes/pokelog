<?php

namespace App\Infrastructure\Factories;

use App\Application\DTOs\PokemonResponseDTO;
use App\Application\Interfaces\PokemonResponseDTOFactoryInterface;

class PokemonResponseDTOFactory implements PokemonResponseDTOFactoryInterface
{
    public function create(
        int $id,
        string $name,
        float $weight,
        float $height,
        array $types
    ): PokemonResponseDTO {
        return new PokemonResponseDTO(
            id: $id,
            name: $name,
            weight: $weight,
            height: $height,
            types: $types
        );
    }
}
