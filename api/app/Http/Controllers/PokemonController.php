<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\GetPokemonByIdUseCaseInterface;
use App\Application\Interfaces\ListPokemonUseCaseInterface;
use App\Application\Interfaces\PokemonRequestDTOFactoryInterface;
use App\Application\Interfaces\SearchPokemonRequestDTOFactoryInterface;
use App\Application\Interfaces\SearchPokemonByNameUseCaseInterface;
use App\Application\Interfaces\SearchPokemonByTypeUseCaseInterface;
use App\Domain\Repositories\PokemonRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function __construct(
        private PokemonRequestDTOFactoryInterface $pokemonRequestDTOFactoryInterface,
        private ListPokemonUseCaseInterface $listPokemonUseCaseInterface,
        private SearchPokemonRequestDTOFactoryInterface $searchPokemonRequestDTOFactory,
        private SearchPokemonByNameUseCaseInterface $searchPokemonByNameUseCase,
        private SearchPokemonByTypeUseCaseInterface $searchPokemonByTypeUseCase,
        private GetPokemonByIdUseCaseInterface $getPokemonByIdUseCaseInterface,
        private PokemonRepositoryInterface $pokemonRepositoryInterface,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pokemonRequest = [
            'page' => $request->query('page', 1),
            'perPage' => $request->query('perPage', 12),
        ];

        $pokemonRequestDTO = $this->pokemonRequestDTOFactoryInterface->create($pokemonRequest);
        $pokemonsResponseDTO = $this->listPokemonUseCaseInterface->execute($pokemonRequestDTO);

        return response()->json($pokemonsResponseDTO->toArray());
    }

    public function search(Request $request): JsonResponse
    {
        $searchParams = [
            'name' => $request->query('name'),
            'type' => $request->query('type'),
        ];

        $searchPokemonRequestDTO = $this->searchPokemonRequestDTOFactory->create($searchParams);

        if ($searchPokemonRequestDTO->name) {
            $pokemonResponseDTO = $this->searchPokemonByNameUseCase->execute($searchPokemonRequestDTO);
        }

        if ($searchPokemonRequestDTO->type) {
            $pokemonResponseDTO = $this->searchPokemonByTypeUseCase->execute($searchPokemonRequestDTO);
        }

        if (isset($pokemonResponseDTO)) {
            return response()->json($pokemonResponseDTO->toArray());
        }

        return response()->json([
            'message' => 'Pokemon não encontrado',
        ], 404);
    }

    public function show(int $id): JsonResponse
    {
        $pokemonDetailsDTO = $this->getPokemonByIdUseCaseInterface->execute($id);

        if ($pokemonDetailsDTO) {
            return response()->json($pokemonDetailsDTO->toArray());
        } else {
            return response()->json(['message' => 'Pokémon não encontrado'], 404);
        }
    }
}
