<script setup>

</script>

<template>
    <div class="border border-gray-200 dark:border-gray-800 rounded-md shadow-sm p-4 dark:text-gray-300">
        <div class="font-medium text-gray-500 mb-1">
            <slot name="title" />
        </div>
        <slot />
    </div>
</template>

<style scoped>

</style>