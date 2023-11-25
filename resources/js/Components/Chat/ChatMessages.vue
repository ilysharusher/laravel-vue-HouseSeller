<script setup>
import useChat from '@/Composables/Chat.js';
import {onMounted} from 'vue';
import {usePage} from '@inertiajs/vue3';
import UserMessage from '@/Components/Chat/Message/UserMessage.vue';
import InterlocutorMessage from '@/Components/Chat/Message/InterlocutorMessage.vue';

const {messages, getMessages} = useChat();

onMounted(() => {
    getMessages();
});

window.Echo.private('chat')
    .listen('.message.sent', (e) => {
        messages.value.push({
            message: e.message,
            user_id: e.user.id,
        });
    });

const userID = usePage().props.auth.user.id;
</script>

<template>
    <div
        v-for="(message, key) in messages"
        :key="key"
        class="grid grid-cols-12 gap-y-2"
    >
        <UserMessage
            v-if="message.user_id === userID"
            :message="message.message"
            :seen="false"
        />
        <InterlocutorMessage
            v-else
            :message="message.message"
        />
    </div>
</template>

<style scoped>

</style>
