<template>
  <main class="max-w-6xl mx-auto bg-blue-200 m-8 p-6 rounded-sm">
    <h1 class="text-2xl font-bold mb-4">POKEDEX LOGCOMEX</h1>
    <RouterView />
  </main>
</template>

<script setup>
import { onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore()

onMounted(() => {
  store.dispatch('getPokemons', 'https://pokeapi.co/api/v2/pokemon?limit=12&offset=0')
})
</script>
