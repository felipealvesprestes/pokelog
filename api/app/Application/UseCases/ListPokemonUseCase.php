<?php

namespace App\Application\UseCases;

use App\Application\DTOs\PokemonListItemDTO;
use App\Application\DTOs\PokemonRequestDTO;
use App\Application\DTOs\PokemonResponseDTO;
use App\Application\Interfaces\ListPokemonUseCaseInterface;
use App\Domain\Entities\Pokemon;
use App\Domain\Repositories\PokemonRepositoryInterface;

class ListPokemonUseCase implements ListPokemonUseCaseInterface
{
    public function __construct(
        private PokemonRepositoryInterface $pokemonRepositoryInterface,
    ) {}

    public function execute(PokemonRequestDTO $pokemonDTO): PokemonResponseDTO
    {
        $pokemonPaginatedData = $this->pokemonRepositoryInterface->getAllPaginated(
            page: $pokemonDTO->page,
            perPage: $pokemonDTO->perPage,
        );

        $pokemons = $pokemonPaginatedData['pokemons'];
        $total = $pokemonPaginatedData['total'];

        $pokemonProcessedData = array_map(function (Pokemon $pokemon) {
            return new PokemonListItemDTO(
                $pokemon->getId(),
                $pokemon->getName(),
                $pokemon->getTypes(),
                $pokemon->getWeightInKilograms(),
                $pokemon->getHeightInCentimeters(),
            );
        }, $pokemons);

        return new PokemonResponseDTO(
            $pokemonProcessedData,
            $total,
            $pokemonDTO->page,
            $pokemonDTO->perPage
        );
    }
}
