<script setup>
import ListingAdress from '@/Components/Listing/ListingAdress.vue';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import ListingSpace from '@/Components/Listing/ListingSpace.vue';
import Box from '@/Components/UI/Box.vue';
import ListingMonthlyPayment from '@/Components/Listing/ListingPayment.vue';
import MakeOffer from '@/Components/Listing/Show/MakeOffer.vue';

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
            <!--            <div
                v-if="listing.images.length"
                id="default-carousel"
                class="relative w-full"
                data-carousel="slide"
            >
                &lt;!&ndash; Carousel wrapper &ndash;&gt;
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    <div
                        v-for="(image, index) in listing.images"
                        :key="index"
                        class="hidden duration-700 ease-in-out"
                        data-carousel-item
                    >
                        <img :src="image.img_src" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="house image">
                    </div>
                </div>
                &lt;!&ndash; Slider indicators &ndash;&gt;
                <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                    <button
                        v-for="(image, index) in listing.images"
                        :key="index"
                        type="button"
                        class="w-3 h-3 rounded-full"
                        aria-current="true"
                        aria-label="Slide"
                        :data-carousel-slide-to="index"
                    ></button>
                </div>
                &lt;!&ndash; Slider controls &ndash;&gt;
                <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>-->

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
                <ListingMonthlyPayment :listing="listing" />
            </Box>
            <Box>
                <template #title>
                    Make an offer
                </template>
                <MakeOffer :listing-id="listing.id" :price="listing.price" />
            </Box>
        </div>
    </div>
</template>

<style scoped>

</style>
