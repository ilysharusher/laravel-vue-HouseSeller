<script setup>
import EmptyPlace from '@/Components/UI/EmptyPlace.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import NewOfferNotification from '@/Components/Notifications/NewOfferNotification.vue';

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
        >
            <NewOfferNotification
                v-if="notification.type === 'App\\Notifications\\OfferMade'"
                :notification="notification"
            />
        </div>
    </section>

    <EmptyPlace v-else>It's empty for now.</EmptyPlace>

    <Pagination v-if="notifications.last_page !== 1" :links="notifications.links" />
</template>

<style scoped>

</style>
