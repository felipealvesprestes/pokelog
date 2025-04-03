import { createStore } from 'vuex';

const store = createStore({
  state() {
    return {
      pokemons: [],
      totalPokemons: 0,
      currentPage: 1,
      perPage: 10,
    };
  },
  mutations: {
    setPokemonsData(state, data) {
      state.pokemons = data.pokemons;
      state.totalPokemons = data.total;
      state.currentPage = data.page;
      state.perPage = data.perPage;
    },
    setCurrentPage(state, page) {
      state.currentPage = page;
    },
  },
  actions: {
    async getPokemons({ commit, state }, page = 1) {
      const url = `http://localhost/api/pokemons?page=${page}&perPage=${state.perPage}`;

      try {
        const response = await fetch(url);
        const data = await response.json();
        commit('setPokemonsData', data);
      } catch (error) {
        console.error('Erro ao buscar Pokémons:', error);
      }
    },
    changePage({ dispatch }, page) {
      dispatch('getPokemons', page);
    },
  },
  getters: {
    totalPages: (state) => Math.ceil(state.totalPokemons / state.perPage),
  },
});

export default store;
