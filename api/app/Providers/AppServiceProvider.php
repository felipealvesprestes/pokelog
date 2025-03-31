<?php

namespace App\Providers;

use App\Application\Interfaces\ListPokemonUseCaseInterface;
use App\Application\Interfaces\PokemonRequestDTOFactoryInterface;
use App\Application\UseCases\ListPokemonUseCase;
use App\Domain\Repositories\PokemonRepositoryInterface;
use App\Infrastructure\Factories\PokemonRequestDTOFactory;
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
