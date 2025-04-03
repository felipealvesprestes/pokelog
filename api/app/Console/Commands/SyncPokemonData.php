<?php

namespace App\Console\Commands;

use App\Domain\Repositories\PokemonRepositoryInterface;
use App\Infrastructure\Services\PokeApiService;
use App\Models\Pokemon as PokemonModel;
use App\Models\Type as TypeModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncPokemonData extends Command
{
    protected $signature = 'app:sync-pokemon-data';
    protected $description = 'Sincroniza os dados dos Pokemons da PokeAPI para o banco de dados local.';

    public function __construct(
        private PokeApiService $pokeApiService,
        private PokemonRepositoryInterface $pokemonRepository,
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Iniciando a sincronização dos dados dos Pokemons... Isso pode levar alguns minutos.');

        $offset = 0;
        $limit = 100;

        do {
            $pokemonData = $this->pokeApiService->get($limit, $offset);

            if (!isset($pokemonData['results'])) {
                $this->error('Erro ao buscar dados da PokeAPI.');
                return;
            }

            DB::beginTransaction();

            try {
                foreach ($pokemonData['results'] as $pokemon) {
                    $details = $this->pokeApiService->getDetails($pokemon['url']);

                    $types = [];

                    if (isset($details['types'])) {
                        foreach ($details['types'] as $type) {
                            $typeId = TypeModel::firstOrCreate(['name' => $type])->id;
                            $types[] = $typeId;
                        }
                    }

                    $pokemonModel = PokemonModel::findOrNew($details['id']);
                    $pokemonModel->name = $details['name'];
                    $pokemonModel->weight = $details['weight'];
                    $pokemonModel->height = $details['height'];
                    $pokemonModel->save();

                    $pokemonModel->types()->sync($types);

                    $this->info("Salvo: " . $pokemonModel->name);
                }

                $offset += $limit;

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();

                $this->error('Erro durante a sincronização: ' . $e->getMessage());
                return;
            }
        } while (isset($pokemonData['next']) && $pokemonData['next']);

        $this->info('Pokemon data synchronization completed.');
    }
}
