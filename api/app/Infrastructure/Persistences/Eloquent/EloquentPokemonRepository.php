<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Entities\Pokemon;
use App\Domain\Repositories\PokemonRepositoryInterface;
use App\Models\Pokemon as PokemonModel;

class EloquentPokemonRepository implements PokemonRepositoryInterface
{
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
            'items' => $this->mapEloquentCollectionToDomain($pokemonModels->items()),
            'total' => $total,
        ];
    }

    public function getById(int $id): ?Pokemon
    {
        $pokemonModel = PokemonModel::find($id);
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

    public function save(Pokemon $pokemon): Pokemon
    {
        $pokemonModel = PokemonModel::findOrNew($pokemon->getId());
        $pokemonModel->name = $pokemon->getName();
        $pokemonModel->weight_hg = $pokemon->getWeight();
        $pokemonModel->height_dm = $pokemon->getHeight();
        $pokemonModel->save();

        // Sincronizar os tipos
        $pokemonModel->types()->sync(
            collect($pokemon->getTypes())->map(function ($typeName) {
                return \App\Models\Type::firstOrCreate(['name' => $typeName])->id;
            })->toArray()
        );

        return $this->mapEloquentModelToDomain($pokemonModel);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection<int,PokemonModel> $collection
     * @return array<Pokemon>
     */
    private function mapEloquentCollectionToDomain($collection): array
    {
        return $collection->map(function ($model) {
            return $this->mapEloquentModelToDomain($model);
        })->toArray();
    }

    private function mapEloquentModelToDomain(PokemonModel $model): Pokemon
    {
        return new Pokemon(
            $model->id,
            $model->name,
            $model->weight_hg,
            $model->height_dm,
            $model->types->pluck('name')->toArray()
        );
    }
}
