<script setup>
defineProps({
    listing: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div>
        {{ listing.street }} {{ listing.street_number }}, {{ listing.city }}
    </div>
</template>

<style scoped>

</style>
