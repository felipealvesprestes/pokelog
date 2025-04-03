<template>
    <div>
        <div class="mb-4 flex items-center w-2/4">
            <select v-model="searchType" class="cursor-pointer rounded-sm p-2 text-gray-700 mr-2 bg-gray-100">
                <option value="name">Nome</option>
                <option value="type">Tipo</option>
            </select>
            <input type="text" v-model="searchTerm"
                :placeholder="`Buscar por ${searchType === 'name' ? 'nome' : 'tipo'}`"
                class="bg-white rounded-sm w-full py-2 px-3 text-gray-700" @input="handleSearchInput" />
            <button @click="searchPokemons"
                class="cursor-pointer ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Buscar
            </button>
            <button v-if="isSearching" @click="clearSearch"
                class="cursor-pointer ml-2 bg-white hover:bg-gray-100 text-gray-700 font-bold py-2 px-4 rounded-full">
                Limpar
            </button>
        </div>

        <Loading v-if="isLoading" />
        <div v-else class="grid sm:grid-cols-3 xl:grid-cols-4 gap-2">
            <Pokemon v-for="pokemon in pokemons" :key="pokemon.id" :pokemon="pokemon" />
        </div>
        <div v-if="!isLoading && totalPages > 1 && !isSearching" class="flex justify-center mt-4">
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
const isSearching = computed(() => store.state.isSearching);

const searchTerm = ref('');
const searchType = ref('name');

const isLoading = ref(false);

const fetchPokemons = async (page = 1) => {
    isLoading.value = true;
    try {
        await store.dispatch('getPokemons', { page, searchTerm: store.state.searchTerm, searchType: store.state.searchType });
    } finally {
        isLoading.value = false;
    }
};

const searchPokemons = async () => {
    isLoading.value = true;
    store.commit('setSearchTerm', searchTerm.value);
    store.commit('setSearchType', searchType.value);
    try {
        await store.dispatch('getPokemons', { searchTerm: searchTerm.value, searchType: searchType.value, page: 1 });
    } finally {
        isLoading.value = false;
    }
};

const clearSearch = async () => {
    isLoading.value = true;
    searchTerm.value = '';
    searchType.value = 'name';
    store.commit('setSearchTerm', '');
    store.commit('setSearchType', '');
    try {
        await store.dispatch('getPokemons');
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
