<script setup>
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

defineProps({
    message: String
});
</script>

<template>
    <MainLayout>
        <h1>Props say: {{ message }}</h1>
        <Link href='/show'>goto Show</Link>
    </MainLayout>
</template>

<style scoped>

</style>