<script setup>
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import {useForm} from '@inertiajs/vue3';
import {computed, watch} from 'vue';
import {debounce} from 'lodash';

const props = defineProps({
    listingId: Number,
    price: Number,
});

const emit = defineEmits(['offerMade']);

const form = useForm({
    price: props.price,
});

watch(
    () => form.price,
    debounce((value) => emit('offerMade', value), 200),
);

const submit = () => form.post(
    route('listing.offer.store', props.listingId),
    {
        preserveScroll: true,
        preserveState: true,
    });

const difference = computed(() => form.price - props.price);
const min = computed(() => Math.round(props.price / 2));
const max = computed(() => Math.round(props.price * 2));
</script>

<template>
    <div>
        <div class="mt-5">
            <form
                @submit.prevent="submit"
            >
                <input v-model="form.price" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-lg" />
                <input
                    v-model.number="form.price"
                    type="range" :min="min"
                    :max="max" step="10000"
                    class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                />

                <button
                    type="submit"
                    class="btn-primary mt-3"
                >
                    Make an Offer
                </button>
                {{ form.errors.price }}
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <ListingPrice :price="difference" />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
