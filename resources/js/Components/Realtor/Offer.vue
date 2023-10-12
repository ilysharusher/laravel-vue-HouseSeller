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

const sold = computed(() => props.offer.accepted_at || props.offer.rejected_at);
</script>

<template>
    <Box>
        <template #title>
            Offer #{{ offer.id }}
            <span v-if="offer.accepted_at" class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                Accepted
            </span>
            <span v-if="offer.rejected_at" class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                Rejected
            </span>
        </template>

        <section class="flex items-center justify-between">
            <div>
                <ListingPrice :price="offer.price" class="text-xl" />

                <div class="text-gray-500">
                    Difference <ListingPrice :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made by {{ offer.bidder.name }}
                </div>

                <div class="text-gray-500 text-sm">
                    Made on {{ madeOn }}
                </div>
            </div>
            <div>
                <Link
                    class="btn-secondary text-xs font-medium"
                    :class="{
                        'opacity-25 pointer-events-none': sold,
                    }"
                    as="button"
                    :href="route('realtor.offer.accept', offer.id)"
                    method="patch"
                >
                    Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<style scoped>

</style>