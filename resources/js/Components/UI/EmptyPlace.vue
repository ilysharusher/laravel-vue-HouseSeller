<script setup>
import Box from '@/Components/UI/Box.vue';
</script>

<template>
    <Box class="flex items-center w-full">
        <div class="w-full text-center font-medium text-gray-500">
            <slot />
        </div>
    </Box>
</template>

<style scoped>

</style>
