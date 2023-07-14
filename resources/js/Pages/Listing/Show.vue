<script setup>
import { Link } from '@inertiajs/vue3';
import ListingAdress from '@/Components/ListingAdress.vue';

defineProps({
    listing: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Link href="/listing">Go back</Link>
    <br />
    <br />
    
    <ListingAdress :listing="listing" />
</template>

<style scoped>

</style>