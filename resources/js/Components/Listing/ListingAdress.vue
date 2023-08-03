<script setup>
defineProps({
    listing: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    {{ listing.city }}
    |
    {{ listing.street }}
    |
    {{ listing.street_number }}
    |
    {{ listing.code }}
</template>

<style scoped>

</style>