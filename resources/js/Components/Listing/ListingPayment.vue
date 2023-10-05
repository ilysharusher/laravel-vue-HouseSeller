<script setup>
import { ref } from 'vue';
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import useMonthlyPayment from '@/Composables/useMonthlyPayment.js';

const props = defineProps({
    offer: {
        type: Number,
        required: true,
    },
});

const interestRate = ref(2.5);
const duration = ref(30);

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.offer, interestRate, duration);
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
    <div class="mt-4 text-gray-500">
        <div class="flex justify-between">
            <div>Base price</div>
            <div>
                <ListingPrice :price="offer" class="font-medium" />
            </div>
        </div>
        <div class="flex justify-between">
            <div>Interests (%)</div>
            <div>
                <ListingPrice :price="totalInterest" class="font-medium" />
            </div>
        </div>
        <div class="flex justify-between">
            <div>Total price</div>
            <div>
                <ListingPrice :price="totalPaid" class="font-medium" />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
