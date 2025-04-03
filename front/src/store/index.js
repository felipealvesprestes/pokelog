import { createStore } from 'vuex';

const store = createStore({
  state() {
    return {
      pokemons: [],
      totalPokemons: 0,
      currentPage: 1,
      perPage: 10,
      searchTerm: '',
      searchType: 'name',
      isSearching: false,
    };
  },
  mutations: {
    setPokemonsData(state, data) {
      if (state.searchTerm) {
        if (state.searchType === 'name' && data && data.id) {
          state.pokemons = [data];
          state.totalPokemons = 1;
        } else if (state.searchType === 'type' && data && data.pokemons) {
          state.pokemons = data.pokemons;
          state.totalPokemons = data.total;
        } else {
          state.pokemons = [];
          state.totalPokemons = 0;
        }
      } else if (data && data.pokemons) {
        state.pokemons = data.pokemons;
        state.totalPokemons = data.total;
      } else {
        state.pokemons = [];
        state.totalPokemons = 0;
      }
      state.currentPage = data ? (data.page || 1) : 1;
      state.perPage = data ? (data.perPage || state.perPage) : state.perPage;
      state.isSearching = !!state.searchTerm;
    },
    setCurrentPage(state, page) {
      state.currentPage = page;
    },
    setSearchTerm(state, term) {
      state.searchTerm = term;
      state.currentPage = 1;
    },
    setSearchType(state, type) {
      state.searchType = type;
      state.currentPage = 1;
    },
  },
  actions: {
    async getPokemons({ commit, state }, { page = 1, searchTerm = '', searchType = 'name' } = {}) {
      let url = `http://localhost/api/pokemons`;
      const params = [];

      if (searchTerm) {
        url += `/search`;
        if (searchType === 'name') {
          params.push(`name=${searchTerm}`);
        } else if (searchType === 'type') {
          params.push(`type=${searchTerm}`);
        }
      } else {
        params.push(`page=${page}`);
        params.push(`perPage=${state.perPage}`);
      }

      if (params.length > 0) {
        url += `?${params.join('&')}`;
      }

      try {
        const response = await fetch(url);
        const data = await response.json();
        commit('setPokemonsData', data);
      } catch (error) {
        console.error('Erro ao buscar Pokémons:', error);
        commit('setPokemonsData', { pokemons: [], total: 0, page: 1, perPage: state.perPage });
      }
    },
    changePage({ dispatch, state }, page) {
      dispatch('getPokemons', { page, searchTerm: state.searchTerm, searchType: state.searchType });
    },
  },
  getters: {
    totalPages: (state) => Math.ceil(state.totalPokemons / state.perPage),
  },
});

export default store;
