<script setup>
import DefaultInput from '@/Components/Forms/Inputs/DefaultInput.vue';
import {Link} from '@inertiajs/vue3';

defineProps({
    form: Object,
    action: String,
    listingId: String,
    imagesCount: Number,
});

defineEmits({
    submit: () => true,
});
</script>

<template>
    <form @submit.prevent="$emit('submit')">
        <div class="grid grid-cols-6 gap-4">
            <DefaultInput :form="form" label="Beds" content="beds" class="col-span-2" />

            <DefaultInput :form="form" label="Baths" content="baths" class="col-span-2" />

            <DefaultInput :form="form" label="Area" content="area" class="col-span-2" />

            <DefaultInput :form="form" label="City" content="city" class="col-span-4" />

            <DefaultInput :form="form" label="Post Code" content="code" class="col-span-2" />

            <DefaultInput :form="form" label="Street" content="street" class="col-span-4" />

            <DefaultInput :form="form" label="Street Nr" content="street_number" class="col-span-2" />

            <DefaultInput :form="form" label="Price" content="price" class="col-span-6" />

            <button type="submit" class="btn-primary col-span-2 w-full">{{ action }}</button>
            <Link
                v-if="listingId"
                class="btn-secondary text-xs font-medium col-span-4 mr-0"
                :href="route('realtor.listing.image.create', listingId)"
                as="button"
            >
                Add images ({{ imagesCount }})
            </Link>
        </div>
    </form>
</template>

<style scoped>

</style>
