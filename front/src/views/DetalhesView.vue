<template>
    <div class="flex flex-col items-center">
        <PokemonDetalhes :pokemonId="$route.params.id" />

        <button @click="voltar()"
            class="bg-purple-500 hover:bg-purple-600 py-2 px-6 rounded-full text-white mt-8 cursor-pointer">Voltar</button>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';

import PokemonDetalhes from '../components/PokemonDetalhes.vue';

const router = useRouter()

function voltar() {
    router.go(-1)
}
</script>
