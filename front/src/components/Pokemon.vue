<template>
    <div v-for="xpto in 12" class="bg-white rounded-sm p-4 hover:shadow">
        <RouterLink to="/pokemons/20/detalhes">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png"
                alt="POKEMON_NOME" class="bg-gray-100 p-4 rounded-sm hover:bg-amber-100">
            <h2 class="text-xl font-semibold mt-4 text-center">pokemon nome</h2>
        </RouterLink>
    </div>
</template>

<script setup>

</script>
