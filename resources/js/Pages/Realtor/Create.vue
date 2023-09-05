<script setup>
import { useForm } from '@inertiajs/vue3';
import ListingForm from '@/Components/Forms/ListingForm.vue';

const form = useForm({
    area: null,
    beds: null,
    baths: null,
    city: null,
    street: null,
    street_number: null,
    code: null,
    price: null,
});

const submit = () => form.post(route('realtor.listing.store'));
</script>

<template>
    <ListingForm :form="form" action="Create" @submit="submit" />
</template>

<style scoped>

</style>