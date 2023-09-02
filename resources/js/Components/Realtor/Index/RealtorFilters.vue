<script setup>
import {reactive, watch} from 'vue';
import {router} from '@inertiajs/vue3';
import {debounce} from 'lodash';

const filterForm = reactive({
    drafts: false,
    deleted: false,
});

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
    <form class="items-center w-[20%] text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg lg:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white my-10">
        <div class="w-full border-b border-gray-200 lg:border-b-0 lg:border-r dark:border-gray-600">
            <div class="flex items-center pl-3">
                <input id="deleted" v-model="filterForm.drafts" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="deleted" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Drafts</label>
            </div>
        </div>
        <div class="w-full dark:border-gray-600">
            <div class="flex items-center pl-3">
                <input id="laravel-checkbox-list" v-model="filterForm.deleted" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="laravel-checkbox-list" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deleted</label>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>