<template>
    <div class="*:cursor-pointer">
        <button @click="emit('page-changed', currentPage - 1)" :disabled="currentPage === 1"
            class="px-3 py-1 rounded-md mr-2 bg-gray-200 hover:bg-gray-300 disabled:opacity-50">
            Anterior
        </button>

        <button v-for="page in pages" :key="page" @click="emit('page-changed', page)" :class="{
                'px-3 py-1 rounded-md mr-1': true,
                'bg-blue-500 text-white hover:bg-blue-600': page === currentPage,
                'bg-gray-200 hover:bg-gray-300': page !== currentPage,
                'font-semibold': page === currentPage,
            }">
            {{ page }}
        </button>

        <button @click="emit('page-changed', currentPage + 1)" :disabled="currentPage === totalPages"
            class="px-3 py-1 rounded-md ml-2 bg-gray-200 hover:bg-gray-300 disabled:opacity-50">
            Próximo
        </button>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    currentPage: {
        type: Number,
        required: true,
    },
    totalPages: {
        type: Number,
        required: true,
    },
});

const emit = defineEmits(['page-changed']);

const pages = computed(() => {
    const totalVisiblePages = 5;

    let startPage = Math.max(1, props.currentPage - Math.floor(totalVisiblePages / 2));
    let endPage = Math.min(props.totalPages, startPage + totalVisiblePages - 1);

    if (endPage - startPage < totalVisiblePages - 1) {
        startPage = Math.max(1, endPage - totalVisiblePages + 1);
    }

    const pageArray = [];

    for (let i = startPage; i <= endPage; i++) {
        pageArray.push(i);
    }

    return pageArray;
});
</script>
