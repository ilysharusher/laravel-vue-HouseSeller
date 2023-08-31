<script setup>
import Box from '@/Components/UI/Box.vue';
import ListingSpace from '@/Components/Listing/ListingSpace.vue';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import ListingAdress from '@/Components/Listing/ListingAdress.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    listings: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section class="mb-8">Filters</section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings" :key="listing.id">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div>
                    <div class="xl:flex items-center gap-2">
                        <ListingPrice :price="listing.price" class="text-2xl font-medium" />
                        <ListingSpace :listing="listing" />
                    </div>

                    <ListingAdress :listing="listing" />
                </div>
                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                    <Link class="btn-secondary text-xs font-medium">Preview</Link>
                    <Link class="btn-secondary text-xs font-medium">Edit</Link>
                    <Link class="btn-red text-xs font-medium">Delete</Link>
                </div>
            </div>
        </Box>
    </section>
</template>

<style scoped>

</style>