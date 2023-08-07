<script setup>
import { useForm } from '@inertiajs/vue3';
import ListingForm from '@/Components/Forms/ListingForm.vue';

const props = defineProps({
    listing: Object,
});

// eslint-disable-next-line vue/no-setup-props-destructure
const form = useForm({
    ...props.listing,
});

const submit = () => form.patch(route('listing.update', props.listing.id));
</script>

<template>
    <ListingForm :form="form" @submit="submit" />
</template>

<style scoped>

</style>