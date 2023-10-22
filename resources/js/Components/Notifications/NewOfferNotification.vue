<script setup>
import {Link} from '@inertiajs/vue3';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import MarkAsReadNotificatioButton from '@/Components/Buttons/MarkAsReadNotificatioButton.vue';

defineProps({
    notification: Object,
});
</script>

<template>
    <div
        class="w-full p-6 bg-white border border-gray-200 rounded-2xl shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 lg:flex justify-between my-5"
        :class="{
            'pointer-events-none opacity-25': notification.read_at,
        }"
    >
        <div>
            <h5
                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
            >
                Offer was made!
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                Offer
                <ListingPrice :price="notification.data.offer_price" />
                for
                <Link :href="route('realtor.listing.show', notification.data.listing_id)" class="text-blue-500">this listing</Link>
                was made!
            </p>
        </div>

        <MarkAsReadNotificatioButton :notification="notification" />
    </div>
</template>

<style scoped>

</style>
