<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Pokemon;

interface PokemonRepositoryInterface
{
    public function getAll(): array;
    public function getAllPaginated(int $page, int $perPage): array;
    public function getByName(?string $name = null): ?Pokemon;
    public function getByType(?string $type = null): array;
    public function getById(int $id): ?Pokemon;
}
