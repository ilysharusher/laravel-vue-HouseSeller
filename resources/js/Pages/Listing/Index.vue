<script setup>
import { Link } from '@inertiajs/vue3';
import Box from '@/Components/UI/Box.vue';
import ListingAdress from '@/Components/Listing/ListingAdress.vue';
import ListingSpace from '@/Components/Listing/ListingSpace.vue';

defineProps({
    listings: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Box
            v-for="listing in listings"
            :key="listing.id"
        >
            <div>
                <Link :href="route('listing.show', listing.id)">
                    <ListingSpace :listing="listing" class="text-lg" />
                    <ListingAdress :listing="listing" class="text-gray-500" />
                </Link>
            </div>
            <div>
                <Link :href="route('listing.edit', listing.id)">Edit</Link>
            </div>
            <div>
                <Link :href="route('listing.destroy', listing.id)" method="delete" as="button">Delete</Link>
            </div>
            <br />
        </Box>
    </div>
</template>

<style scoped>

</style>