<script setup>
import { Link } from '@inertiajs/vue3';
import Box from '@/Components/UI/Box.vue';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import {computed} from 'vue';

const props = defineProps({
    offer: Object,
    price: Number,
});

const difference = computed(
    () => props.offer.price - props.price,
);

const madeOn = computed(
    () => new Date(props.offer.created_at).toDateString(),
);
</script>

<template>
    <Box>
        <template #title>Offer #{{ offer.id }}</template>

        <section class="flex items-center justify-between">
            <div>
                <ListingPrice :price="offer.price" class="text-xl" />

                <div class="text-gray-500">
                    Difference <ListingPrice :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made by John Doe
                </div>

                <div class="text-gray-500 text-sm">
                    Made on {{ madeOn }}
                </div>
            </div>
            <div>
                <Link
                    class="btn-secondary text-xs font-medium"
                    as="button"
                >
                    Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<style scoped>

</style>