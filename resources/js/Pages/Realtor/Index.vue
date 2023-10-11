<script setup>
import Box from '@/Components/UI/Box.vue';
import ListingSpace from '@/Components/Listing/ListingSpace.vue';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import ListingAdress from '@/Components/Listing/ListingAdress.vue';
import { Link } from '@inertiajs/vue3';
import RealtorFilters from '@/Components/Realtor/Index/RealtorFilters.vue';
import Pagination from '@/Components/UI/Pagination.vue';

defineProps({
    listings: Object,
    filters: Object,
});
</script>

<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <RealtorFilters :filters="filters" />
    <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box 
            v-for="listing in listings.data" 
            :key="listing.id"
            :class="{
                'border-dashed': listing.deleted_at,
            }"
        >
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div
                    :class="{
                        'opacity-25': listing.deleted_at,
                    }"
                >
                    <div class="xl:flex items-center gap-2">
                        <ListingPrice :price="listing.price" class="text-2xl font-medium" />
                        <ListingSpace :listing="listing" />
                    </div>

                    <ListingAdress :listing="listing" />
                </div>
                
                <section>
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <a
                            :class="{
                                'opacity-25 pointer-events-none': listing.deleted_at,
                            }"
                            class="btn-secondary text-xs font-medium"
                            :href="route('listing.show', listing.id)"
                            target="_blank"
                        >
                            Preview
                        </a>
                        <Link
                            :class="{
                                'opacity-25 pointer-events-none': listing.deleted_at,
                            }"
                            class="btn-secondary text-xs font-medium"
                            :href="route('realtor.listing.edit', listing.id)"
                            as="button"
                        >
                            Edit
                        </Link>
                        <Link
                            v-if="!listing.deleted_at"
                            class="btn-red text-xs font-medium"
                            :href="route('realtor.listing.destroy', listing.id)"
                            method="delete"
                            as="button"
                        >
                            Delete
                        </Link>
                        <Link
                            v-else
                            class="btn-green text-xs font-medium"
                            :href="route('realtor.listing.restore', listing.id)"
                            method="patch"
                            as="button"
                        >
                            Restore
                        </Link>
                    </div>
                    <div class="mt-2 pr-2">
                        <Link :href="route('realtor.listing.show', listing.id)" class="btn-primary block w-full">Offers ({{ listing.offers_count }})</Link>
                    </div>
                </section>
            </div>
        </Box>
    </section>
    <div
        v-if="listings.data.length"
        class="py-12 w-full flex justify-center"
    >
        <Pagination v-if="listings.last_page !== 1" :links="listings.links" />
    </div>
</template>

<style scoped>

</style>