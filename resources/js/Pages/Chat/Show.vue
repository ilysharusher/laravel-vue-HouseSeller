<script setup>

import ChatMessages from '@/Components/Chat/Show/ChatMessages.vue';
import ChatForm from '@/Components/Chat/Show/ChatForm.vue';
import {onBeforeMount, ref} from 'vue';
import {useForm, usePage} from '@inertiajs/vue3';
import LeftSide from '@/Components/Chat/Show/LeftSide.vue';
import Pagination from '@/Components/Chat/Show/Pagination.vue';

const props = defineProps({
    chat: {
        type: Object,
    },
    users: {
        type: Array,
        default: () => [],
    },
    messages: {
        type: Array,
        default: () => [],
    },
    isLastPage: {
        type: Boolean,
        default: false,
    },
});

const messages = ref(props.messages.slice().reverse());
const userId = usePage().props.auth.user.id;
let page = 1;
const isLastPage = ref(props.isLastPage);

onBeforeMount(() => {
    window.Echo.private(`store-message-event-${props.chat.id}-chat`)
        .listen('.store-message-event', (e) => {
            messages.value.push(e.message);

            if (window.location.href === window.route('chats.show', {chat: props.chat.id})) {
                window.axios.patch(window.route('update.message.status'), {
                    user_id: userId,
                    chat_id: props.chat.id,
                    message_id: e.message.id,
                });
            }
        });

    window.Echo.private(`message-read-event-${props.chat.id}-chat`)
        .listen('.message-read-event', (e) => {
            const message = messages.value.find(message => message.id === e.message_id);
            if (message) {
                message.is_read = true;
            }
        });
});

const interlocutor = props.users.find((user) => user.id !== userId);

const form = useForm({
    chat_id: props.chat.id,
    interlocutor: interlocutor.id,
    text: '',
});

const store = (text) => {
    form.text = text;

    window.axios.post(window.route('messages.store'), form)
        .then((result) => {
            messages.value.push(result.data);
        });
};

const loadMoreMessages = () => {
    window.axios.post(window.route('load.messages', {chat_id: props.chat.id, page: ++page}))
        .then((result) => {
            messages.value = result.data.messages.concat(messages.value);
            isLastPage.value = result.data.is_last_page;
        });
};
</script>

<template>
    <div
        class="h-screen overflow-hidden flex rounded-2xl bg-gray-200 dark:bg-gray-800"
        style="height: calc(100vh - 160px);"
    >
        <div class="flex h-screen antialiased text-gray-800 dark:text-white" style="height: calc(100vh - 160px);">
            <div class="flex flex-col md:flex-row h-full w-full overflow-x-hidden mx-auto">
                <LeftSide :interlocutor="interlocutor" />
                <div class="flex flex-col flex-auto h-full p-6 md:w-2/3">
                    <div
                        class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 dark:bg-gray-900 h-full p-4"
                    >
                        <div class="flex flex-col h-full overflow-x-auto mb-4">
                            <Pagination v-if="!isLastPage" @load-more-messages="loadMoreMessages" />
                            <div class="flex flex-col h-full">
                                <ChatMessages v-if="messages.length" :messages="messages" />
                            </div>
                        </div>
                        <ChatForm @store="store" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
