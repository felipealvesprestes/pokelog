<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\ListPokemonUseCaseInterface;
use App\Application\Interfaces\PokemonRequestDTOFactoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function __construct(
        private PokemonRequestDTOFactoryInterface $pokemonRequestDTOFactoryInterface,
        private ListPokemonUseCaseInterface $listPokemonUseCaseInterface,
    ) {}

    public function index(Request $resquest): JsonResponse
    {
        $pokemonRequest = [
            'page' => $resquest->query('page', 1),
            'perPage' => $resquest->query('perPage', 10),
        ];

        $pokemonRequestDTO = $this->pokemonRequestDTOFactoryInterface->create($pokemonRequest);
        $pokemonResponseDTO = $this->listPokemonUseCaseInterface->execute($pokemonRequestDTO);

        return response()->json($pokemonResponseDTO->toArray());
    }
}
