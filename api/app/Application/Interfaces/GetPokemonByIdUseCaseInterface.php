<?php

namespace App\Application\Interfaces;

use App\Application\DTOs\PokemonListItemDTO;

interface GetPokemonByIdUseCaseInterface
{
    public function execute(int $id): ?PokemonListItemDTO;
}
