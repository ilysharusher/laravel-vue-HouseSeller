<script setup>
import ListingPrice from '@/Components/Listing/ListingPrice.vue';

defineProps({
    listing: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div>
        <label class="label">Interest rate (2.5%)</label>
        <input
            type="range" min="0.1" max="30" step="0.1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
        />

        <label class="label">Duration (30 years)</label>
        <input
            type="range" min="3" max="30" step="1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
        />
    </div>
    <div class="class=&quot;text-gray-600 dark:text-gray-300 mt-2">
        <div class="text-gray-400">Your monthly payment</div>
        <ListingPrice :price="500" class="text-3xl" />
    </div>
</template>

<style scoped>

</style>