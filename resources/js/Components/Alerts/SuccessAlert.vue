<script setup>
import {ref} from 'vue';

defineProps({
    flashSuccess: {
        type: String,
        default: '',
    },
});

/*const show = ref(true);

setTimeout(() => {
    show.value = false;
}, 5000);*/
</script>

<template>
    <transition name="slide-fade">
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-2xl bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Success!</span> {{ flashSuccess }}
            </div>
        </div>
    </transition>
</template>

<style scoped>
/*.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}*/
</style>
