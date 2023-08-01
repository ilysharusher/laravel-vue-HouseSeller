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
            <Link :href="route('listing.show', listing.id)">{{ listing.id }}</Link>
        </div>
        <div>
            <Link :href="route('listing.edit', listing.id)">Edit</Link>
        </div>
        <div>
            <Link :href="route('listing.destroy', listing.id)" method="delete" as="button">Delete</Link>
        </div>
        <br />
    </div>
</template>

<style scoped>

</style>