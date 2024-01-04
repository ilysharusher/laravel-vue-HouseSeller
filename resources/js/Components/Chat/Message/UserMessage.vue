<script setup>

defineProps({
    message: Object,
});
</script>

<template>
    <div class="col-start-6 col-end-13 p-3 rounded-lg">
        <div class="flex items-center justify-start flex-row-reverse">
            <div
                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0"
            >
                A
            </div>
            <div
                class="relative mr-3 text-sm bg-indigo-100 dark:bg-gray-800 py-2 px-4 shadow rounded-xl"
            >
                <div class="flex flex-col items-end">
                    <div class="flex-grow">
                        {{ message.text }}
                    </div>
                    <div
                        class="text-xs text-gray-500 mt-1"
                    >
                        {{ message.time }} - <span
                            :class="message.is_read ? 'text-green-500': 'text-yellow-500'"
                        >{{ message.is_read ? 'read' : 'sent' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

<style scoped>

</style>
