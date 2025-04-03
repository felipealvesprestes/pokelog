<template>
    <div>
        <img :src="pokemonImageUrl" :alt="pokemonName" class="w-72">
        <h2 class="text-2xl font-semibold mt-4 text-center capitalize">{{ pokemonName }}</h2>
        <div v-if="pokemonDetails" class="mt-6 bg-white rounded-sm p-4">
            <p class="text-gray-700 m-2">
                <span class="font-semibold">Peso:</span>
                {{ pokemonDetails.weight }} kg
            </p>
            <p class="text-gray-700 m-2">
                <span class="font-semibold">Altura:</span>
                {{ pokemonDetails.height }} cm
            </p>
            <p class="text-gray-700 m-2">
                <span class="font-semibold">Tipos:</span>
                <span v-for="type in pokemonDetails.types" :key="type"
                    class="inline-block mx-2 px-3 py-1 rounded-full bg-amber-200 text-gray-800 text-sm font-semibold">{{
                    type }}</span>
            </p>
        </div>
        <div v-else class="flex justify-center items-center h-64">
            <p>Carregando detalhes...</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    pokemonId: {
        type: Number,
        required: true
    }
})

const pokemonDetails = ref(null);
const pokemonName = ref('');
const pokemonImageUrl = ref('');

onMounted(async () => {
    try {
        const response = await fetch(`http://localhost/api/pokemons/${props.pokemonId}`);
        if (!response.ok) {
            throw new Error('Erro ao buscar detalhes do Pokémon');
        }
        const data = await response.json();
        pokemonDetails.value = data;
        pokemonName.value = data.name;
        pokemonImageUrl.value = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${props.pokemonId}.png`;
    } catch (error) {
        console.error(error);
    }
})
</script>
