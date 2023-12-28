<script setup>

import {router} from '@inertiajs/vue3';

const props = defineProps({
    listing: {
        type: Object,
        required: true,
    },
});

const store = (id) => {
    router.post(window.route('chats.store', {
        user: id,
        listing_id: props.listing.id,
    }));
};
</script>

<template>
    <button
        class="btn-secondary w-full h-full"
        @click="store(listing.user_id)"
    >
        Write to seller
    </button>
</template>

<style scoped>

</style>
