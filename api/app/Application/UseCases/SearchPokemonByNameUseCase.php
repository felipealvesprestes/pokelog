<?php

namespace App\Application\UseCases;

use App\Application\DTOs\PokemonResponseDTO;
use App\Application\DTOs\SearchPokemonRequestDTO;
use App\Application\Interfaces\PokemonResponseDTOFactoryInterface;
use App\Application\Interfaces\SearchPokemonByNameUseCaseInterface;
use App\Domain\Repositories\PokemonRepositoryInterface;

class SearchPokemonByNameUseCase implements SearchPokemonByNameUseCaseInterface
{
    public function __construct(
        private PokemonRepositoryInterface $pokemonRepository,
        private PokemonResponseDTOFactoryInterface $pokemonResponseDTOFactory,
    ) {}

    public function execute(SearchPokemonRequestDTO $searchPokemonRequestDTO): ?PokemonResponseDTO
    {
        $pokemon = $this->pokemonRepository->getByName($searchPokemonRequestDTO->name);

        if (!$pokemon) {
            return null;
        }

        return $this->pokemonResponseDTOFactory->create(
            id: $pokemon->getId(),
            name: $pokemon->getName(),
            weight: $pokemon->getWeightInKilograms(),
            height: $pokemon->getHeightInCentimeters(),
            types: $pokemon->getTypes(),
        );
    }
}
