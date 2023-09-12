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
    );

    reset();
};

const reset = () => form.reset('images');
</script>

<template>
    <Box>
        <template #title>Upload New Images</template>
        <form
            @submit.prevent="submit"
        >
            <div class="flex items-center justify-center w-full my-4">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
                    </div>
                    <input id="dropzone-file" type="file" multiple class="hidden" @input="addImage" />
                </label>
            </div>

            <div>
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
            </div>
        </form>
    </Box>

    <Box v-if="listing.images.length" class="mt-3">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div
                v-for="image in listing.images"
                :key="image.id"
            >
                <img class="h-auto max-w-full rounded-lg" :src="image.img_src" alt="image">
            </div>
        </div>
    </Box>
</template>

<style scoped>

</style>