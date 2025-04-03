<template>
    <div>
        <Loading v-if="isLoading" />
        <div v-else class="grid sm:grid-cols-3 xl:grid-cols-4 gap-2">
            <Pokemon v-for="pokemon in pokemons" :key="pokemon.id" :pokemon="pokemon" />
        </div>
        <div v-if="!isLoading && totalPages > 1" class="flex justify-center mt-4">
            <Pagination :currentPage="currentPage" :totalPages="totalPages" @page-changed="handlePageChange" />
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { useStore } from 'vuex';

import Pokemon from '../components/Pokemon.vue';
import Pagination from '../components/Pagination.vue';
import Loading from '../components/Loading.vue';

const store = useStore();

const pokemons = computed(() => store.state.pokemons);
const currentPage = computed(() => store.state.currentPage);
const totalPages = computed(() => store.getters.totalPages);

const isLoading = ref(false);

const fetchPokemons = async (page = 1) => {
    isLoading.value = true;
    try {
        await store.dispatch('getPokemons', page);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchPokemons();
});

const handlePageChange = (page) => {
    fetchPokemons(page);
};
</script>
