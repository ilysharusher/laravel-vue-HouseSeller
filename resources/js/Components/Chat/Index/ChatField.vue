<script setup>

import {Link} from '@inertiajs/vue3';

const props = defineProps({
    chat: {
        type: Object,
        required: true,
    },
});

console.log(props.chat.unread_message_statuses_count);
</script>

<template>
    <div
        class="w-full p-6 bg-white border rounded-2xl shadow hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 lg:flex justify-between my-5"
        :class="props.chat.unread_message_statuses_count ? 'border-red-500 dark:border-red-500' : 'border-gray-200 dark:border-gray-700'"
    >
        <div>
            <div
                class="font-medium text-gray-500"
                :class="props.chat.unread_message_statuses_count ? 'text-red-500 font-bold' : 'text-gray-700 dark:text-gray-400 opacity-50'"
            >
                {{ props.chat.last_message.time }}
                <span v-if="props.chat.unread_message_statuses_count">- {{ props.chat.unread_message_statuses_count }} unread message(s)</span>
            </div>
            <h5
                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
            >
                {{ props.chat.title }}
            </h5>
            <!--            <p
                class="font-normal"
                :class="props.chat.unread_message_statuses_count ? 'text-red-500 font-bold' : 'text-gray-700 dark:text-gray-400 opacity-50'"
            >
                {{ props.chat.last_message.text }}
            </p>-->
        </div>

        <Link
            :href="route('chats.show', props.chat.id)"
            as="button"
            method="get"
            class="btn-secondary flex items-center justify-center mt-5 lg:mt-0"
            :class="{
                'border-red-500': props.chat.unread_message_statuses_count > 0,
            }"
        >
            Go to chat
        </Link>
    </div>
</template>

<style scoped>

</style>
