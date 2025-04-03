<?php

namespace App\Application\UseCases;

use App\Application\DTOs\PokemonListItemDTO;
use App\Application\Interfaces\GetPokemonByIdUseCaseInterface;
use App\Application\Interfaces\PokemonListItemDTOFactoryInterface;
use App\Domain\Repositories\PokemonRepositoryInterface;

class GetPokemonByIdUseCase implements GetPokemonByIdUseCaseInterface
{
    public function __construct(
        private PokemonRepositoryInterface $pokemonRepository,
        private PokemonListItemDTOFactoryInterface $pokemonListItemDTOFactoryInterface,
    ) {}

    public function execute(int $id): ?PokemonListItemDTO
    {
        $pokemonData = $this->pokemonRepository->getById($id);

        if (!$pokemonData) {
            return null;
        }

        $pokemonData = [
            'id' => $pokemonData->getId(),
            'name' => $pokemonData->getName(),
            'types' => $pokemonData->getTypes(),
            'weight' => $pokemonData->getWeightInKilograms(),
            'height' => $pokemonData->getHeightInCentimeters(),
        ];

        return $this->pokemonListItemDTOFactoryInterface->create($pokemonData);
    }
}
