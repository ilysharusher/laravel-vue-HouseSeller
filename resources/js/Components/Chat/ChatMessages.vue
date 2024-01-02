<script setup>
import {usePage} from '@inertiajs/vue3';
import UserMessage from '@/Components/Chat/Message/UserMessage.vue';
import InterlocutorMessage from '@/Components/Chat/Message/InterlocutorMessage.vue';

defineProps({
    messages: {
        type: Array,
        default: () => [],
    },
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
            v-if="message.is_owner"
            :message="message.text"
            :seen="false"
        />
        <InterlocutorMessage
            v-else
            :message="message.text"
        />
    </div>
</template>

<style scoped>

</style>
