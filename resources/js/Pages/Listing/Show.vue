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
import EmptyPlace from '@/Components/UI/EmptyPlace.vue';
import UnsuccessAlert from '@/Components/Alerts/UnsuccessAlert.vue';
import InfoAlert from '@/Components/Alerts/InfoAlert.vue';
import WriteToSellerButton from '@/Components/Buttons/WriteToSellerButton.vue';

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
        <Box v-if="listing.images.length" class="lg:col-span-7 flex items-center w-full">
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-3">
                <div
                    v-for="(image, index) in listing.images"
                    :key="index"
                    class="relative w-full"
                >
                    <img class="h-auto max-w-full rounded-xl" :src="image.img_src" alt="house image">
                </div>
            </div>
        </Box>

        <EmptyPlace v-else class="lg:col-span-7 flex items-center w-full">
            No image yet :(
        </EmptyPlace>

        <div class="lg:col-span-5 flex flex-col gap-4">
            <Box>
                <template #title>
                    About this listing
                </template>
                <div class="flex justify-between mt-3">
                    <div>
                        <ListingPrice :price="listing.price" class="text-2xl font-bold" />
                        <ListingSpace :listing="listing" class="text-lg" />
                        <ListingAdress :listing="listing" class="text-gray-500" />
                    </div>
                    <div
                        v-if="props.listing.user_id !== user?.id"
                        :class="{
                            'opacity-25 pointer-events-none': !user || listing.user_id === user.id,
                        }"
                    >
                        <WriteToSellerButton :listing="listing" />
                    </div>
                </div>
            </Box>
            <InfoAlert v-if="user?.id === listing.user_id" flash-info="This is your listing. You can see more detailed statistics in your personal cabinet." />
            <Box>
                <template #title>
                    Monthly payment
                </template>
                <ListingPayment
                    class="mt-3"
                    :class="{
                        'opacity-25 pointer-events-none': !user || listing.user_id === user.id,
                    }" :offer="offer"
                />
            </Box>
            <UnsuccessAlert v-if="!user" class="-mb-0.5" flash-unsuccess="Sign in to your account to make offers." />
            <Box v-if="!offerMade">
                <template #title>
                    Make an offer
                </template>
                <MakeOffer
                    :class="{
                        'opacity-25 pointer-events-none': !user || listing.user_id === user.id,
                    }" :listing-id="listing.id" :price="listing.price" @offer-made="offer = $event"
                />
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
