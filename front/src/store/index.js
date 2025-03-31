import { createStore } from 'vuex'

const store = createStore({
  state () {
    return {
        pokemons: {}
    }
  },
  mutations: {
    setPokemons(state, pokemons) {
      state.pokemons = pokemons
    }
  },
  actions: {
    async getPokemons({ commit }, url) {
      const response = await fetch(url).then(response => response)
      const pokemonsData = await response.json()

      commit('setPokemons', pokemonsData)
    }
  }
})

export default store
