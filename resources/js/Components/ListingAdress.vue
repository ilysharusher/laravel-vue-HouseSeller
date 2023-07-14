<script setup>
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