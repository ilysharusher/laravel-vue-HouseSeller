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
        <span class="font-bold">{{ listing.beds }}</span> beds <span class="text-gray-400">| </span>
        <span class="font-bold">{{ listing.baths }}</span> baths <span class="text-gray-400">| </span>
        <span class="font-bold">{{ listing.area }}</span> m²
    </div>
</template>

<style scoped>

</style>