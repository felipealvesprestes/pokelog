<template>
    <div class="grid sm:grid-cols-3 xl:grid-cols-4 gap-2">
        <Pokemon />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';

import Pokemon from '../components/Pokemon.vue';

const store = useStore()

const pokemons = computed(() => {
    return store.state.pokemons
})
</script>
