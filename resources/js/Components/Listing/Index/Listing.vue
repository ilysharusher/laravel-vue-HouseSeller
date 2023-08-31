<script setup>
import Box from '@/Components/UI/Box.vue';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import ListingSpace from '@/Components/Listing/ListingSpace.vue';
import { Link } from '@inertiajs/vue3';
import ListingAdress from '@/Components/Listing/ListingAdress.vue';
import useMonthlyPayment from '@/Composables/useMonthlyPayment.js';

const props = defineProps({
    listing: {
        type: Object,
        required: true,
    },
});

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 30);
</script>
    
<template>
    <Box>
        <div>
            <Link :href="route('listing.show', listing.id)">
                <div class="flex items-center gap-1">
                    <ListingPrice :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <p>~ <ListingPrice :price="monthlyPayment" /> per month</p>
                    </div>
                </div>
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAdress :listing="listing" class="text-gray-500" />
            </Link>
        </div>
        <br />
    </Box>
</template>

<style scoped>

</style>
