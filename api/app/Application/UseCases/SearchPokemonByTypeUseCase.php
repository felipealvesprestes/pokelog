<?php

namespace App\Application\UseCases;

use App\Application\DTOs\PokemonsResponseDTO;
use App\Application\DTOs\SearchPokemonRequestDTO;
use App\Application\Interfaces\PokemonListItemDTOFactoryInterface;
use App\Application\Interfaces\PokemonsResponseDTOFactoryInterface;
use App\Application\Interfaces\SearchPokemonByTypeUseCaseInterface;
use App\Domain\Repositories\PokemonRepositoryInterface;

class SearchPokemonByTypeUseCase implements SearchPokemonByTypeUseCaseInterface
{
    public function __construct(
        private PokemonRepositoryInterface $pokemonRepository,
        private PokemonListItemDTOFactoryInterface $pokemonListItemDTOFactoryInterface,
        private PokemonsResponseDTOFactoryInterface $pokemonsResponseDTOFactoryInterface,
    ) {}

    public function execute(SearchPokemonRequestDTO $searchPokemonRequestDTO): ?PokemonsResponseDTO
    {
        $pokemonsResponse = $this->pokemonRepository->getByType($searchPokemonRequestDTO->type);

        if (!$pokemonsResponse) {
            return null;
        }

        $pokemonProcessedData = array_map(function ($pokemon) {
            $pokemonData = [
                'id' => $pokemon->getId(),
                'name' => $pokemon->getName(),
                'types' => $pokemon->getTypes(),
                'weight' => $pokemon->getWeightInKilograms(),
                'height' => $pokemon->getHeightInCentimeters(),
            ];

            return $this->pokemonListItemDTOFactoryInterface->create($pokemonData);
        }, $pokemonsResponse);

        return $this->pokemonsResponseDTOFactoryInterface->create(
            $pokemonProcessedData,
            total: count($pokemonProcessedData),
        );
    }
}
