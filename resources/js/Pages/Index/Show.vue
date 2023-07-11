<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
    layout: MainLayout
};
</script>

<template>
    <h1>Show</h1>
    <Link href='/'>goto Index</Link>
</template>

<style scoped>

</style>