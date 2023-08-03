<script setup>
import ListingAdress from '@/Components/Listing/ListingAdress.vue';

defineProps({
    listing: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <ListingAdress :listing="listing" />
</template>

<style scoped>

</style>