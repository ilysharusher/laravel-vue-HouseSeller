<script setup>
import Box from '@/Components/UI/Box.vue';
import ListingSpace from '@/Components/Listing/ListingSpace.vue';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import ListingAdress from '@/Components/Listing/ListingAdress.vue';
import { Link } from '@inertiajs/vue3';
import {computed} from 'vue';
import Offer from '@/Components/Realtor/Offer.vue';

const props = defineProps({
    listing: Object,
});

const hasOffers = computed(() => props.listing.offers.length);
</script>

<template>
    <div class="mb-4">
        <Link
            :href="route('realtor.listing.index')"
        >
            ← Go back to Listings
        </Link>
    </div>

    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No offers
            </div>
        </Box>

        <div v-else class="md:col-span-7 items-center">
            <Offer v-for="offer in listing.offers" :key="offer.id" :offer="offer" :price="listing.price" :user="listing.user" />
        </div>

        <Box class="md:col-span-5">
            <template #title>Basic Info</template>
            <ListingPrice :price="listing.price" class="text-2xl font-bold" />

            <ListingSpace :listing="listing" class="text-lg" />
            <ListingAdress :listing="listing" class="text-gray-500" />
        </Box>
    </section>
</template>

<style scoped>

</style>