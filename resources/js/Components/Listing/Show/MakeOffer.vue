<script setup>
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';

const props = defineProps({
    listingId: Number,
    price: Number,
});
const form = useForm({
    amount: props.price,
});
const difference = computed(() => form.amount - props.price);
const min = computed(() => props.price / 2);
const max = computed(() => props.price * 2);
</script>

<template>
    <div class="mt-3">
        <form>
            <input v-model="form.amount" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-lg" />
            <input
                v-model.number="form.amount"
                type="range" :min="min"
                :max="max" step="10000"
                class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
            />

            <button type="submit" class="btn-primary mt-3">
                Make an Offer
            </button>
        </form>
    </div>
    <div class="flex justify-between text-gray-500 mt-2">
        <div>Difference</div>
        <div>
            <ListingPrice :price="difference" />
        </div>
    </div>
</template>

<style scoped>

</style>