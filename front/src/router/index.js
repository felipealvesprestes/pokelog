import { createWebHistory, createRouter } from 'vue-router'

import ListagemView from '../views/ListagemView.vue'
import DetalhesView from '../views/DetalhesView.vue'

const routes = [
  { path: '/', component: ListagemView },
  { path: '/pokemons/:id/detalhes', component: DetalhesView },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
