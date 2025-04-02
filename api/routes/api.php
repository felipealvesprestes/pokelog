<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/pokemons', [PokemonController::class, 'index']);
Route::get('/pokemons/search', [PokemonController::class, 'search']);
