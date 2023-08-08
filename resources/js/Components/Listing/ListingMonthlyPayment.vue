<script setup>
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import { computed, ref } from 'vue';

const props = defineProps({
    listing: {
        type: Object,
        required: true,
    },
});

const interestRate = ref(2.5);
const duration = ref(30);

const monthlyPayment = computed(() => {
    const price = props.listing.price;
    const interest = interestRate.value / 100 / 12;
    const payments = duration.value * 12;

    const x = Math.pow(1 + interest, payments);
    const monthly = (price * x * interest) / (x - 1);

    return monthly.toFixed(2);
});
</script>

<template>
    <div>
        <label class="label">Interest rate ({{ interestRate }}%)</label>
        <input
            v-model="interestRate"
            type="range" min="0.1" max="30" step="0.1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
        />

        <label class="label">Duration ({{ duration }} years)</label>
        <input
            v-model="duration"
            type="range" min="3" max="30" step="1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
        />
    </div>
    <div class="class=&quot;text-gray-600 dark:text-gray-300 mt-2">
        <div class="text-gray-400">Your monthly payment</div>
        <ListingPrice :price="monthlyPayment" class="text-3xl" />
    </div>
</template>

<style scoped>

</style>