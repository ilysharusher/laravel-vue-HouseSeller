<script setup>
import {reactive, watch, computed} from 'vue';
import {router} from '@inertiajs/vue3';
import {debounce} from 'lodash';

const props = defineProps({
    filters: Object,
});

const filterForm = reactive({
    drafts: props.filters.drafts ?? false,
    deleted: props.filters.deleted ?? false,
    by: props.filters.by ?? 'created_at',
    order: props.filters.order ?? 'desc',
});

const sortLabels = {
    created_at: [
        {
            label: 'Latest',
            value: 'desc',
        },
        {
            label: 'Oldest',
            value: 'asc',
        },
    ],
    price: [
        {
            label: 'Pricey',
            value: 'desc',
        },
        {
            label: 'Cheapest',
            value: 'asc',
        },
    ],
};

const sortOptions = computed(() => sortLabels[filterForm.by]);

watch(filterForm,
    debounce(() => {
        router.get(
            route('realtor.listing.index'),
            filterForm,
            {
                preserveState: true,
                preserveScroll: true,
            });
    }, 1000),
);
</script>

<template>
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
        <div class="items-center w-[15%] text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg xl:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white my-10">
            <div class="w-full border-b border-gray-200 xl:border-b-0 xl:border-r dark:border-gray-600">
                <div class="flex items-center pl-3">
                    <input id="deleted" v-model="filterForm.drafts" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="deleted" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Drafts</label>
                </div>
            </div>
            <div class="w-full dark:border-gray-600">
                <div class="flex items-center pl-3">
                    <input id="laravel-checkbox-list" v-model="filterForm.deleted" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="laravel-checkbox-list" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deleted</label>
                </div>
            </div>
        </div>
        <div class="flex flex-nowrap items-center">
            <select
                v-model="filterForm.by"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500 min-w-[100px]"
            >
                <option value="created_at">Added</option>
                <option value="price">Price</option>
            </select>

            <select
                v-model="filterForm.order"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500 min-w-[100px]"
            >
                <option
                    v-for="option in sortOptions"
                    :key="option.value"
                    :value="option.value"
                >
                    {{ option.label }}
                </option>
            </select>
        </div>
    </div>
</template>

<style scoped>

</style>