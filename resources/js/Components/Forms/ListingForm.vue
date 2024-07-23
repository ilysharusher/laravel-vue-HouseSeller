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
    submit: (submit) => true,
});
</script>

<template>
    <form @submit.prevent>
        <div class="grid grid-cols-6 gap-4">
            <DefaultInput :form="form" label="Beds" content="beds" class="col-span-2" />

            <DefaultInput :form="form" label="Baths" content="baths" class="col-span-2" />

            <DefaultInput :form="form" label="Area" content="area" class="col-span-2" />

            <DefaultInput :form="form" label="City" content="city" class="col-span-4" />

            <DefaultInput :form="form" label="Post Code" content="code" class="col-span-2" />

            <DefaultInput :form="form" label="Street" content="street" class="col-span-4" />

            <DefaultInput :form="form" label="Street Nr" content="street_number" class="col-span-2" />

            <DefaultInput :form="form" label="Price" content="price" class="col-span-6" />

            <button
                type="button"
                class="btn-primary col-span-2 w-full"
                @click="$emit('submit', 'Create')"
            >
                {{ action }}
            </button>
            <button
                v-if="!listingId"
                type="button"
                class="text-white bg-gradient-to-r col-span-3 from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-xl text-sm px-5 py-2.5 text-center mr-2 mb-2"
                @click="$emit('submit', 'CreateWithPhotos')"
            >
                Create with images
            </button>
            <Link
                v-if="listingId"
                class="btn-secondary text-xs font-medium col-span-3 mr-0"
                :href="route('realtor.listing.image.create', listingId)"
                as="button"
            >
                Change images ({{ imagesCount }})
            </Link>
        </div>
    </form>
</template>

<style scoped>
</style>
