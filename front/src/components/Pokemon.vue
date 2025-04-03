<template>
    <div class="bg-white rounded-sm p-4 hover:shadow">
        <RouterLink :to="`/pokemons/${pokemon.id}/detalhes`">
            <img :src="`https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${pokemon.id}.png`"
                :alt="pokemon.name" class="bg-gray-100 p-4 rounded-sm hover:bg-amber-100">
            <h2 class="text-xl font-semibold mt-4 text-center">{{ pokemon.name }}</h2>
        </RouterLink>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    pokemon: {
        type: Object,
        required: true
    }
});
</script>
