<script setup>

import {nextTick, onMounted, ref} from 'vue';

const emits = defineEmits(['store']);

const text = ref('');

const resizeTextarea = (event) => {
    const textarea = event.target;
    textarea.style.height = 'auto';

    if (textarea.scrollHeight > textarea.clientHeight) {
        textarea.style.height = textarea.scrollHeight + 'px';
    } else {
        textarea.style.height = '44px';
    }
};

onMounted(() => {
    nextTick(() => {
        const textarea = document.getElementById('autoresizing');
        textarea.style.height = textarea.scrollHeight + 'px';
        textarea.addEventListener('input', resizeTextarea);
    });
});

const store = () => {
    emits('store', text.value);

    text.value = '';
};
</script>

<template>
    <div
        class="flex flex-row items-center h-16 rounded-2xl bg-white dark:bg-gray-800 w-full px-4"
    >
        <div>
            <button
                class="flex items-center justify-center text-gray-400 hover:text-gray-600"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                    ></path>
                </svg>
            </button>
        </div>
        <div class="flex-grow ml-4">
            <div class="relative w-full">
                <textarea
                    id="autoresizing"
                    v-model="text"
                    placeholder="Your Message..."
                    type="text"
                    class="flex w-full border rounded-2xl focus:outline-none focus:border-indigo-300 pl-4 pr-12 h-11 dark:bg-gray-700 resize-none"
                    @keydown.enter="store"
                />
                <button
                    class="absolute flex items-center justify-center h-full w-12 right-0 top-0 text-gray-400 hover:text-gray-600"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        ></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="ml-4">
            <button
                class="flex items-center justify-center bg-indigo-500 dark:bg-indigo-600 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0"
                @click="store"
            >
                <span>Send</span>
                <span class="ml-2">
                    <svg
                        class="w-4 h-4 transform rotate-45 -mt-px"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                        ></path>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</template>

<style scoped>
textarea::-webkit-scrollbar {
    display: none;
}

textarea {
    scrollbar-width: none;
    -ms-overflow-style: none;
}
</style>
