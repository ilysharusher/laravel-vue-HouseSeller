<script setup>
import Box from '@/Components/UI/Box.vue';
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';

const props = defineProps({
    listing: Object,
});

const form = useForm({
    images: [],
});

const canUpload = computed(
    () => form.images.length,
);

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
            <section class="flex items-center gap-2 my-4">
                <input
                    class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                    type="file" multiple @input="addImage"
                />
                <button
                    :class="{
                        'opacity-25 pointer-events-none': !canUpload,
                    }"
                    type="submit"
                    class="btn-primary"
                >
                    Upload
                </button>
                <button
                    :class="{
                        'opacity-25 pointer-events-none': !canUpload,
                    }"
                    type="reset" class="btn-secondary"
                    @click="reset"
                >
                    Reset
                </button>
            </section>
        </form>
    </Box>
</template>

<style scoped>

</style>