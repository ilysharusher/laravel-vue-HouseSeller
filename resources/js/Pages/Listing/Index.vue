<script setup>
import Listing from '@/Components/Listing/Index/Listing.vue';
import Pagination from '@/Components/UI/Pagination.vue';

defineProps({
    listings: Object,
});
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Listing
            v-for="listing in listings.data"
            :key="listing.id"
            :listing="listing"
        />
    </div>
    <div
        v-if="listings.data.length"
        class="py-12 w-full flex justify-center"
    >
        <Pagination :links="listings.links" />
    </div>
</template>

<style scoped>

</style>
