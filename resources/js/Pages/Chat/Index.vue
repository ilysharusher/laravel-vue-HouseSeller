<script setup>
import {Link} from '@inertiajs/vue3';
import Pagination from '@/Components/UI/Pagination.vue';
import EmptyPlace from '@/Components/UI/EmptyPlace.vue';

defineProps({
    chats: Object,
});
</script>

<template>
    <div class="flex justify-between">
        <h1 class="text-3xl mb-4">Your Chats</h1>
        <Link
            :href="route('notification.destroy_all')"
            method="delete"
            as="button"
            class="btn-secondary"
            :class="{'opacity-25 pointer-events-none': chats.length === 0}"
        >
            Delete All Chats
        </Link>
    </div>

    <section v-if="chats">
        <div
            v-for="(chat, id) in chats.data"
            :key="id"
        >
            <!--            <NewOfferNotification
                v-if="notification.type === 'App\\Notifications\\OfferMade'"
                :notification="notification"
            />-->
        </div>
    </section>

    <EmptyPlace v-else>It's empty for now.</EmptyPlace>

<!--    <Pagination v-if="chats.last_page !== 1" :links="chats.links" />-->
</template>

<style scoped>

</style>
