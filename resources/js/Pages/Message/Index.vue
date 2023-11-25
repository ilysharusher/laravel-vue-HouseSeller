<script setup>

import ChatForm from '@/Components/Chat/ChatForm.vue';
import ChatMessages from '@/Components/Chat/ChatMessages.vue';
import useChat from '@/Composables/Chat.js';
import UnsuccessAlert from '@/Components/Alerts/UnsuccessAlert.vue';

const {errors, addMessage} = useChat();

const sendMessage = async (form) => {
    await addMessage(form);
};
</script>

<template>
    <div class="h-screen overflow-hidden flex items-center justify-center rounded-2xl bg-gray-200 dark:bg-gray-800">
        <div class="flex h-screen antialiased text-gray-800 dark:text-white">
            <div class="flex flex-row h-full w-full overflow-x-hidden">
                <!--                <RightSide />-->
                <div class="flex flex-col flex-auto h-full p-6">
                    <div
                        class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 dark:bg-gray-900 h-full p-4"
                    >
                        <div class="flex flex-col h-full overflow-x-auto mb-4">
                            <div class="flex flex-col h-full">
                                <ChatMessages />
                            </div>
                        </div>
                        <div v-if="errors" class="mb-4">
                            <UnsuccessAlert
                                v-for="(error, key) in errors"
                                :key="key"
                                :flash-unsuccess="error[0]"
                            />
                        </div>
                        <ChatForm @send-message="sendMessage" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
