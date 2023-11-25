<script setup>

</script>

<template>
    <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white dark:bg-gray-800 flex-shrink-0">
        <div class="flex flex-row items-center h-12 w-full">
            <div
                class="flex items-center justify-center rounded-xl text-indigo-700 bg-indigo-100 h-10 w-10"
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
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                    ></path>
                </svg>
            </div>
            <div>
                <div class="ml-2 font-bold text-2xl">Chat</div>
            </div>
        </div>
        <div class="flex flex-col mt-8">
            <div class="flex flex-row items-center justify-between text-xs">
                <span class="font-bold">Unread Chats</span>
                <span
                    class="flex items-center justify-center bg-gray-300 dark:bg-gray-500 h-4 w-4 rounded-full"
                >4</span>
            </div>
            <div class="flex flex-col space-y-1 mt-4 overflow-y-auto">
                <button
                    class="flex flex-row items-center hover:bg-gray-900 rounded-xl p-2"
                >
                    <div
                        class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full"
                    >
                        H
                    </div>
                    <div class="ml-2 text-sm font-semibold">Henry Boyd</div>
                </button>
                <button
                    class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2"
                >
                    <div
                        class="flex items-center justify-center h-8 w-8 bg-gray-200 rounded-full"
                    >
                        M
                    </div>
                    <div class="ml-2 text-sm font-semibold">Marta Curtis</div>
                    <div
                        class="flex items-center justify-center ml-auto text-xs text-white bg-red-500 h-4 w-4 rounded leading-none"
                    >
                        2
                    </div>
                </button>
                <button
                    class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2"
                >
                    <div
                        class="flex items-center justify-center h-8 w-8 bg-orange-200 rounded-full"
                    >
                        P
                    </div>
                    <div class="ml-2 text-sm font-semibold">Philip Tucker</div>
                </button>
                <button
                    class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2"
                >
                    <div
                        class="flex items-center justify-center h-8 w-8 bg-pink-200 rounded-full"
                    >
                        C
                    </div>
                    <div class="ml-2 text-sm font-semibold">Christine Reid</div>
                </button>
                <button
                    class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2"
                >
                    <div
                        class="flex items-center justify-center h-8 w-8 bg-purple-200 rounded-full"
                    >
                        J
                    </div>
                    <div class="ml-2 text-sm font-semibold">Jerry Guzman</div>
                </button>
            </div>
            <div class="flex flex-row items-center justify-between text-xs mt-6">
                <span class="font-bold">Archivied</span>
                <span
                    class="flex items-center justify-center bg-gray-300 h-4 w-4 rounded-full"
                >7</span>
            </div>
            <div class="flex flex-col space-y-1 mt-4 -mx-2">
                <button
                    class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2"
                >
                    <div
                        class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full"
                    >
                        H
                    </div>
                    <div class="ml-2 text-sm font-semibold">Henry Boyd</div>
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
