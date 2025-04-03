<?php

namespace App\Infrastructure\Persistences\Eloquent;

use App\Domain\Repositories\PokemonRepositoryInterface;
use App\Infrastructure\Services\PokeApiService;
use App\Domain\Entities\Pokemon;
use App\Models\Pokemon as PokemonModel;


class EloquentPokemonRepository implements PokemonRepositoryInterface
{
    public function __construct(
        private PokeApiService $pokeApiService,
    ) {}

    public function getAll(): array
    {
        $pokemonModels = PokemonModel::all();
        return $this->mapEloquentCollectionToDomain($pokemonModels);
    }

    public function getAllPaginated(int $page, int $perPage, ?string $name = null, ?string $type = null): array
    {
        $query = PokemonModel::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($type) {
            $query->whereHas('types', function ($query) use ($type) {
                $query->where('name', $type);
            });
        }

        $total = $query->count();
        $pokemonModels = $query->paginate($perPage, ['*'], 'page', $page);

        return [
            'pokemons' => $this->mapEloquentCollectionToDomain($pokemonModels->items()),
            'total' => $total,
        ];
    }

    public function getById(int $id): ?Pokemon
    {
        $pokemonModel = PokemonModel::with('types')->find($id);
        return $pokemonModel ? $this->mapEloquentModelToDomain($pokemonModel) : null;
    }

    public function getByName(?string $name = null): ?Pokemon
    {
        if (!$name) {
            return null;
        }

        $pokemonModel = PokemonModel::where('name', 'like', '%' . $name . '%')->first();

        return $pokemonModel ? $this->mapEloquentModelToDomain($pokemonModel) : null;
    }

    public function getByType(?string $type = null): array
    {
        if (!$type) {
            return [];
        }

        $pokemonModels = PokemonModel::whereHas('types', function ($query) use ($type) {
            $query->where('name', $type);
        })->get();

        return $this->mapEloquentCollectionToDomain($pokemonModels);
    }

    private function mapEloquentCollectionToDomain($collection): array
    {
        return collect($collection)->map(function ($model) {
            return $this->mapEloquentModelToDomain($model);
        })->toArray();
    }

    private function mapEloquentModelToDomain(PokemonModel $model): Pokemon
    {
        return new Pokemon(
            id: $model->id,
            name: $model->name,
            weight: $model->weight,
            height: $model->height,
            types: $model->types->pluck('name')->toArray()
        );
    }
}
