<script setup>
import ListingAdress from '@/Components/Listing/ListingAdress.vue';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import ListingSpace from '@/Components/Listing/ListingSpace.vue';
import Box from '@/Components/UI/Box.vue';
import ListingPayment from '@/Components/Listing/ListingPayment.vue';
import MakeOffer from '@/Components/Listing/Show/MakeOffer.vue';
import {ref} from 'vue';
import {usePage} from '@inertiajs/vue3';
import OfferMade from '@/Components/Listing/Show/OfferMade.vue';

const props = defineProps({
    listing: {
        type: Object,
        required: true,
    },
    offerMade: {
        type: Object,
        required: false,
    },
});

const offer = ref(props.listing.price);
const user = usePage().props.auth.user;
</script>

<template>
    <div class="flex flex-col-reverse lg:grid lg:grid-cols-12 gap-4">
        <Box class="lg:col-span-7 flex items-center w-full">
            <div
                v-if="listing.images.length"
                class="grid grid-cols-1 xl:grid-cols-2 gap-3"
            >
                <div
                    v-for="(image, index) in listing.images"
                    :key="index"
                    class="relative w-full"
                >
                    <img class="h-auto max-w-full rounded-xl" :src="image.img_src" alt="house image">
                </div>
            </div>

            <div 
                v-else 
                class="w-full text-center font-medium text-gray-500"
            >
                No image yet :(
            </div>
        </Box>
        <div class="lg:col-span-5 flex flex-col gap-4">
            <Box>
                <template #title>
                    About this listing
                </template>
                <ListingPrice :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAdress :listing="listing" class="text-gray-500" />
            </Box>
            <Box>
                <template #title>
                    Monthly payment
                </template>
                <ListingPayment :offer="offer" />
            </Box>
            <Box v-if="!offerMade">
                <template #title>
                    Make an offer
                </template>
                <MakeOffer :listing-id="listing.id" :price="listing.price" @offer-made="offer = $event" />
            </Box>
            <Box v-if="user && offerMade">
                <template #title>
                    Offer Made
                </template>
                <OfferMade :offer-made="offerMade" />
            </Box>
        </div>
    </div>
</template>

<style scoped>

</style>
