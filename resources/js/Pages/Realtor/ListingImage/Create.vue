<script setup>
import Box from '@/Components/UI/Box.vue';
import {useForm, Link} from '@inertiajs/vue3';
import {computed} from 'vue';
import UnsuccessAlert from '@/Components/Alerts/UnsuccessAlert.vue';

const props = defineProps({
    listing: Object,
});

const form = useForm({
    images: [],
});

const upload = (event) => {
    for (const image of event.target.files) {
        form.images.push(image);
    }

    form.post(
        route('realtor.listing.image.store', props.listing.id),
    );

    reset();
};

const reset = () => form.reset('images');

const imageError = computed(() => Object.values(form.errors));
</script>

<template>
    <unsuccess-alert v-if="imageError.length" :flash-unsuccess="imageError[0]" />
    <Box class="pb-2">
        <template #title>Upload New Images</template>
        <div>
            <div class="flex items-center justify-center w-full my-4">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">JPG, JPEG or PNG</p>
                    </div>
                    <input id="dropzone-file" type="file" multiple class="hidden" @input="upload" />
                </label>
            </div>

            <div>
                <Link
                    :class="{
                        'opacity-25 pointer-events-none': listing.images.length === 0,
                    }"
                    method="delete"
                    type="button"
                    class="btn-secondary w-full text-center"
                    :href="route('realtor.listing.image.destroy.all', listing.id)"
                >
                    Delete all images
                </Link>
            </div>
        </div>
    </Box>

    <Box v-if="listing.images.length" class="mt-3">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            <div
                v-for="image in listing.images"
                :key="image.id"
                class="bg-white border border-gray-200 rounded-xl shadow dark:bg-gray-900 dark:border-gray-700"
            >
                <div class="flex flex-col">
                    <div>
                        <img class="rounded-xl" :src="image.img_src" alt="image" />
                    </div>
                    <div
                        class="p-5"
                    >
                        <Link
                            :href="route('realtor.listing.image.destroy', { listing: listing.id, image: image.id })"
                            method="delete"
                            as="button"
                            class="btn-secondary w-full my-0"
                        >
                            Delete
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </Box>
</template>

<style scoped>

</style>