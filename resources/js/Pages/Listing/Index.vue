<script setup>
import Listing from '@/Components/Listing/Index/Listing.vue';

defineProps({
    listings: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Listing
            v-for="listing in listings"
            :key="listing.id"
            :listing="listing"
        />
    </div>
</template>

<style scoped>

</style>
