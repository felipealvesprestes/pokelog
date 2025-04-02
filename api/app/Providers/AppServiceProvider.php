<?php

namespace App\Providers;

use App\Application\Interfaces\ListPokemonUseCaseInterface;
use App\Application\Interfaces\PokemonListItemDTOFactoryInterface;
use App\Application\Interfaces\PokemonRequestDTOFactoryInterface;
use App\Application\Interfaces\PokemonResponseDTOFactoryInterface;
use App\Application\Interfaces\PokemonsResponseDTOFactoryInterface;
use App\Application\Interfaces\SearchPokemonRequestDTOFactoryInterface;
use App\Application\Interfaces\SearchPokemonByNameUseCaseInterface;
use App\Application\Interfaces\SearchPokemonByTypeUseCaseInterface;
use App\Application\UseCases\ListPokemonUseCase;
use App\Application\UseCases\SearchPokemonByNameUseCase;
use App\Application\UseCases\SearchPokemonByTypeUseCase;
use App\Domain\Factories\PokemonEntityFactoryInterface;
use App\Domain\Repositories\PokemonRepositoryInterface;
use App\Infrastructure\Factories\PokemonEntityFactory;
use App\Infrastructure\Factories\PokemonListItemDTOFactory;
use App\Infrastructure\Factories\PokemonRequestDTOFactory;
use App\Infrastructure\Factories\PokemonResponseDTOFactory;
use App\Infrastructure\Factories\PokemonsResponseDTOFactory;
use App\Infrastructure\Factories\SearchPokemonRequestDTOFactory;
use App\Infrastructure\Repositories\PokemonRepository;
use App\Infrastructure\Services\PokeApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ListPokemonUseCaseInterface::class, ListPokemonUseCase::class);
        $this->app->bind(PokemonRequestDTOFactoryInterface::class, PokemonRequestDTOFactory::class);
        $this->app->bind(PokemonRepositoryInterface::class, PokemonRepository::class);
        $this->app->bind(SearchPokemonRequestDTOFactoryInterface::class, SearchPokemonRequestDTOFactory::class);
        $this->app->bind(SearchPokemonByNameUseCaseInterface::class, SearchPokemonByNameUseCase::class);
        $this->app->bind(SearchPokemonByTypeUseCaseInterface::class, SearchPokemonByTypeUseCase::class);
        $this->app->bind(PokemonEntityFactoryInterface::class, PokemonEntityFactory::class);
        $this->app->bind(PokemonListItemDTOFactoryInterface::class, PokemonListItemDTOFactory::class);
        $this->app->bind(PokemonsResponseDTOFactoryInterface::class, PokemonsResponseDTOFactory::class);
        $this->app->bind(PokemonResponseDTOFactoryInterface::class, PokemonResponseDTOFactory::class);

        $this->app->bind(PokeApiService::class, function ($app) {
            return new PokeApiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
