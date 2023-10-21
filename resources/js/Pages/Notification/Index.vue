<script setup>
import EmptyPlace from '@/Components/UI/EmptyPlace.vue';
import {Link} from '@inertiajs/vue3';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import Pagination from '@/Components/UI/Pagination.vue';

defineProps({
    notifications: Object,
});
</script>

<template>
    <h1 class="text-3xl mb-4">Your Notifications</h1>

    <section v-if="notifications.data.length">
        <div
            v-for="(notification, id) in notifications.data"
            :key="id"
            class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 lg:flex justify-between"
        >
            <div>
                <h5
                    v-if="notification.type === 'App\\Notifications\\OfferMade'"
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
            <Link
                :class="{
                    'opacity-25 pointer-events-none': notification.read_at,
                }"
                class="btn-secondary flex items-center justify-center mt-5 lg:mt-0"
            >
                Mark as read
            </Link>
        </div>
    </section>

    <EmptyPlace v-else>It's empty for now.</EmptyPlace>

    <Pagination v-if="notifications.last_page !== 1" :links="notifications.links" />
</template>

<style scoped>

</style>
