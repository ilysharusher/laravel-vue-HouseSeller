<script setup>
defineProps({
    message: Object,
});
</script>

<template>
    <div class="col-start-1 col-end-8 p-3 rounded-lg">
        <div class="flex flex-row items-center">
            <div
                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0"
            >
                A
            </div>
            <div
                class="relative ml-3 text-sm bg-white dark:bg-gray-700 py-2 px-4 shadow rounded-xl"
            >
                <div class="flex flex-col items-start">
                    <div class="flex-grow">
                        {{ message.text }}
                    </div>
                    <div
                        class="text-xs text-gray-500 mt-1"
                    >
                        {{ message.time }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
