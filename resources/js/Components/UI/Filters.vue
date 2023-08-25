<script setup>
import FiltersForm from '@/Components/Forms/FiltersForm.vue';
import {useForm} from '@inertiajs/vue3';

const filterForm = useForm({
    priceFrom: null,
    priceTo: null,
    beds: null,
    baths: null,
    areaFrom: null,
    areaTo: null,
});

</script>

<template>
    <FiltersForm :filter-form="filterForm" />
</template>

<style scoped>

</style>