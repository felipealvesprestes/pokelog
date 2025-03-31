<?php

namespace App\Domain\Repositories;

interface PokemonRepositoryInterface
{
    public function getAllPaginated(int $page, int $perPage): array;
}
