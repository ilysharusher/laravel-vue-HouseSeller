<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    listing: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    |
    <Link :href="route('listing.index')">Go back</Link>
    <br />
    <br />

    {{ listing.id }}
    |
    {{ listing.area }}
    |
    {{ listing.beds }}
    |
    {{ listing.baths }}
    |
    {{ listing.city }}
    |
    {{ listing.street }}
    |
    {{ listing.street_number }}
    |
    {{ listing.code }}
    |
    {{ listing.price }}
</template>

<style scoped>

</style>