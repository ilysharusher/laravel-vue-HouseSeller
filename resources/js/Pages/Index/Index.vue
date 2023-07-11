<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    message: String
});
</script>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
    layout: MainLayout
};
</script>

<template>
    <h1>Props say: {{ message }}</h1>
    <Link href='/show'>goto Show</Link>
</template>

<style scoped>

</style>