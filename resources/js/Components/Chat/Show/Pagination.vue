<script setup>
defineEmits(['loadMoreMessages']);
</script>

<template>
    <div class="mx-auto">
        <button
            class="flex items-center justify-center text-gray-400 hover:text-gray-600"
            @click="$emit('loadMoreMessages')"
        >
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 15l7-7 7 7"
                ></path>
            </svg>
        </button>
    </div>
</template>

<style scoped>

</style>
