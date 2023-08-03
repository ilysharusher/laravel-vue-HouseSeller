<script setup>
import { computed } from 'vue';

const props = defineProps({
    price: {
        type: [Number, String],
        required: true,
    },
    currency: {
        type: String,
        required: false,
        default: 'USD',
    },
});

const formattedPrice = computed(
    () => Number(props.price)
        .toLocaleString('en-US', {
            style: 'currency',
            currency: props.currency,
            maximumFractionDigits: 0,
        }),
);
</script>

<template>
    <span>{{ formattedPrice }}</span>
</template>

<style scoped>

</style>