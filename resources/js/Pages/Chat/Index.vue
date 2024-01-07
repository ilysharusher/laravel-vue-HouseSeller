<script setup>
import {Link, usePage} from '@inertiajs/vue3';
import EmptyPlace from '@/Components/UI/EmptyPlace.vue';
import {onBeforeMount} from 'vue';
import ChatField from '@/Components/Chat/Index/ChatField.vue';

const props = defineProps({
    chats: {
        type: Array,
        default: () => [],
    },
});

onBeforeMount(() => {
    window.Echo.private(`store-message-status-event-${usePage().props.auth.user.id}-user`)
        .listen('.store-message-status-event', (e) => {
            props.chats.forEach(chat => {
                if (chat.id === e.chat_id) {
                    chat.unread_message_statuses_count = e.count;
                    chat.last_message = e.message;
                }
            });
        });
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
            v-for="(chat, id) in chats"
            :key="id"
        >
            <ChatField
                :chat="chat"
            />
        </div>
    </section>

    <EmptyPlace v-else>It's empty for now.</EmptyPlace>
</template>

<style scoped>

</style>
