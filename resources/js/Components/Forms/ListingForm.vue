<script setup>
import ListingInput from '@/Components/Forms/Inputs/ListingInput.vue';

defineProps({
    form: Object,
});

defineEmits({
    submit: () => true,
});
</script>

<template>
    <form @submit.prevent="$emit('submit')">
        <div class="grid grid-cols-6 gap-4">
            <ListingInput :form="form" label="Beds" content="beds" class="col-span-2" />

            <ListingInput :form="form" label="Baths" content="baths" class="col-span-2" />

            <ListingInput :form="form" label="Area" content="area" class="col-span-2" />

            <ListingInput :form="form" label="City" content="city" class="col-span-4" />

            <ListingInput :form="form" label="Post Code" content="code" class="col-span-2" />

            <ListingInput :form="form" label="Street" content="street" class="col-span-4" />

            <ListingInput :form="form" label="Street Nr" content="street_number" class="col-span-2" />

            <ListingInput :form="form" label="Price" content="price" class="col-span-6" />

            <div class="col-span-6">
                <button type="submit" class="btn-primary">Edit</button>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
