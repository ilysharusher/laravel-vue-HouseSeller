<script setup>
import { useForm } from '@inertiajs/vue3';
import ListingForm from '@/Components/Forms/ListingForm.vue';

const props = defineProps({
    listing: Object,
    imagesCount: Number,
});

const form = useForm({
    ...props.listing,
});

const submit = () => form.patch(route('realtor.listing.update', props.listing.id));
</script>

<template>
    <ListingForm :form="form" :images-count="imagesCount" action="Edit" :listing-id="listing.id" @submit="submit" />
</template>

<style scoped>

</style>