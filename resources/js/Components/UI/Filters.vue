<script setup>
import FiltersForm from '@/Components/Forms/FiltersForm.vue';
import {useForm} from '@inertiajs/vue3';

const props = defineProps({
    filters: Object,
});

const filterForm = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null,
});

const submit = () => {
    filterForm.get(
        route('listing.index'),
        {
            preserveState: true,
            preserveScroll: true,
        },
    );
};

const reset = () => {
    filterForm.priceFrom = null;
    filterForm.priceTo = null;
    filterForm.beds = null;
    filterForm.baths = null;
    filterForm.areaFrom = null;
    filterForm.areaTo = null;

    submit();
};
</script>

<template>
    <FiltersForm :filter-form="filterForm" @submit="submit" @reset="reset" />
</template>

<style scoped>

</style>