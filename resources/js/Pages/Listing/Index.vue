<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    listings: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div
        v-for="listing in listings"
        :key="listing.id"
    >
        <Link :href="`listing/${listing.id}`">{{ listing.id }}</Link>
    </div>
</template>

<style scoped>

</style>