<script setup>
import {Link} from '@inertiajs/vue3';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import MarkAsReadNotificationButton from '@/Components/Buttons/MarkAsReadNotificationButton.vue';

const props = defineProps({
    notification: Object,
});

const formattedDate = new Intl.DateTimeFormat('en-US', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    hour12: false,
}).format(new Date(props.notification.created_at)).replace(/\//g, '-').replace(/,/, ' at');
</script>

<template>
    <div
        class="w-full p-6 bg-white border border-gray-200 rounded-2xl shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 lg:flex justify-between my-5"
        :class="{
            'pointer-events-none opacity-25': notification.read_at,
        }"
    >
        <div>
            <div class="font-medium text-gray-500">
                {{ formattedDate }}
            </div>
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

        <MarkAsReadNotificationButton :notification="notification" />
    </div>
</template>

<style scoped>

</style>
