<script setup>
import Box from '@/Components/UI/Box.vue';
import {useForm} from '@inertiajs/vue3';

const props = defineProps({
    listing: Object,
});

const form = useForm({
    images: [],
});

const addImage = (event) => {
    for (const image of event.target.files) {
        form.images.push(image);
    }
};

const submit = () => {
    form.post(
        route('realtor.listing.image.store', props.listing.id),
        {
            onSuccess: () => form.reset('images'),
        },
    );
};

const reset = () => form.reset('images');
</script>

<template>
    <Box>
        <template #title>Upload New Images</template>
        <form
            @submit.prevent="submit"
        >
            <input type="file" multiple @input="addImage" />
            <button type="submit" class="btn-primary" @click="submit">Send</button>
            <button type="reset" class="btn-secondary" @click="reset">Reset</button>
        </form>
    </Box>
</template>

<style scoped>

</style>