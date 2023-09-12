<script setup>

</script>

<template>
    <div class="border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm p-4 dark:text-gray-300">
        <div class="font-medium text-gray-500">
            <slot name="title" />
        </div>
        <slot />
    </div>
</template>

<style scoped>

</style>