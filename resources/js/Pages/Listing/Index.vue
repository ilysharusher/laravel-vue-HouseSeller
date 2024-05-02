<script setup>
import Listing from '@/Components/Listing/Index/Listing.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import Filters from '@/Components/UI/Filters.vue';
import EmptyPlace from '@/Components/UI/EmptyPlace.vue';

defineProps({
    listings: Object,
    filters: Object,
});
</script>

<template>
    <div v-if="listings.data.length">
        <Filters :filters="filters" />
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <Listing
                v-for="listing in listings.data"
                :key="listing.id"
                :listing="listing"
            />
        </div>
    </div>
    <EmptyPlace v-else>
        No listings found :(
    </EmptyPlace>
    <div
        v-if="listings.data.length"
        class="py-12 w-full flex justify-center"
    >
        <Pagination v-if="listings.last_page !== 1" :links="listings.links" />
    </div>
</template>

<style scoped>

</style>
