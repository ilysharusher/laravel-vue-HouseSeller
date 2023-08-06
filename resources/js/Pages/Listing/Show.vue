<script setup>
import ListingAdress from '@/Components/Listing/ListingAdress.vue';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import ListingSpace from '@/Components/Listing/ListingSpace.vue';
import Box from '@/Components/UI/Box.vue';

defineProps({
    listing: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="flex flex-col-reverse lg:grid lg:grid-cols-12 gap-4">
        <Box class="lg:col-span-7 flex items-center w-full">
            <div class="w-full text-center font-medium text-gray-500">
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
                    Buy this home
                </template>
                Make an offer
            </Box>
        </div>
    </div>
</template>

<style scoped>

</style>