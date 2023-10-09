<script setup>
import ListingPrice from '@/Components/Listing/ListingPrice.vue';
import {computed} from 'vue';

const props = defineProps({
    offerMade: {
        type: Object,
        required: true,
    },
});

const offerMadeOn = computed(
    () => new Date(props.offerMade.created_at).toDateString(),
);
</script>

<template>
    <ListingPrice :price="offerMade.price" class="text-3xl" />

    <section class="mt-2 flex flex-col md:flex-row justify-between text-gray-500">
        <div>Made on</div>
        <div class="font-medium">{{ offerMadeOn }}</div>
    </section>
</template>

<style scoped>

</style>