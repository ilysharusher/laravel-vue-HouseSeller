<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Header from '@/Components/Layout/Header.vue';
import SuccessAlert from '@/Components/Alerts/SuccessAlert.vue';

const flashSuccess = computed(
    () => usePage().props.flash.success,
);
</script>

<template>
    <Header />

    <main class="container mx-auto p-4">
        <SuccessAlert v-if="flashSuccess" :flash-success="flashSuccess" />
        <slot />
    </main>
</template>

<style scoped></style>