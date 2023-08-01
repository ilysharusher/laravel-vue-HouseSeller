<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    listings: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div
        v-for="listing in listings"
        :key="listing.id"
    >
        <div>
            <Link :href="`listing/${listing.id}`">{{ listing.id }}</Link>
        </div>
        <div>
            <Link :href="`listing/${listing.id}/edit`">Edit</Link>
        </div>
    </div>
</template>

<style scoped>

</style>