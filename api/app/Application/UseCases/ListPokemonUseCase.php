<?php

namespace App\Application\UseCases;

use App\Application\DTOs\PokemonRequestDTO;
use App\Application\DTOs\PokemonsResponseDTO;
use App\Application\Interfaces\ListPokemonUseCaseInterface;
use App\Application\Interfaces\PokemonListItemDTOFactoryInterface;
use App\Application\Interfaces\PokemonsResponseDTOFactoryInterface;
use App\Domain\Entities\Pokemon;
use App\Domain\Repositories\PokemonRepositoryInterface;

class ListPokemonUseCase implements ListPokemonUseCaseInterface
{
    public function __construct(
        private PokemonRepositoryInterface $pokemonRepositoryInterface,
        private PokemonListItemDTOFactoryInterface $pokemonListItemDTOFactoryInterface,
        private PokemonsResponseDTOFactoryInterface $pokemonsResponseDTOFactoryInterface,
    ) {}

    public function execute(PokemonRequestDTO $pokemonDTO): PokemonsResponseDTO
    {
        $pokemonPaginatedData = $this->pokemonRepositoryInterface->getAllPaginated(
            page: $pokemonDTO->page,
            perPage: $pokemonDTO->perPage,
        );

        $pokemons = $pokemonPaginatedData['pokemons'];
        $total = $pokemonPaginatedData['total'];

        $pokemonProcessedData = array_map(function (Pokemon $pokemon) {
            $pokemonData = [
                'id' => $pokemon->getId(),
                'name' => $pokemon->getName(),
                'types' => $pokemon->getTypes(),
                'weight' => $pokemon->getWeightInKilograms(),
                'height' => $pokemon->getHeightInCentimeters(),
            ];

            return $this->pokemonListItemDTOFactoryInterface->create($pokemonData);
        }, $pokemons);

        return $this->pokemonsResponseDTOFactoryInterface->create(
            $pokemonProcessedData,
            $total,
            $pokemonDTO->page,
            $pokemonDTO->perPage
        );
    }
}
