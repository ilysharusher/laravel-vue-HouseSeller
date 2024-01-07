<script setup>
import UserMessage from '@/Components/Chat/Message/UserMessage.vue';
import InterlocutorMessage from '@/Components/Chat/Message/InterlocutorMessage.vue';

defineProps({
    messages: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <div
        v-for="(message, key) in messages"
        :key="key"
        class="grid grid-cols-12 gap-y-2"
    >
        <UserMessage
            v-if="message.is_owner"
            :message="message"
        />
        <InterlocutorMessage
            v-else
            :message="message"
        />
    </div>
</template>

<style scoped>

</style>
