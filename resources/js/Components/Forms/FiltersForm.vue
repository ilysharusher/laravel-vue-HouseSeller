<script setup>

import DefaultInput from '@/Components/Forms/Inputs/DefaultInput.vue';

defineProps({
    filterForm: Object,
});
</script>

<template>
    <form>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
            <div class="flex flex-nowrap items-center">
                <DefaultInput :form="filterForm" content="{{filterForm.priceFrom}}" placeholder="Price from" change-round="l" />
                <DefaultInput :form="filterForm" content="{{filterForm.priceTo}}" placeholder="Price to" change-round="r" />
            </div>

            <div class="flex flex-nowrap items-center">
                <select 
                    :id="filterForm.beds"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                >
                    <option :value="null">Beds</option>
                    <option v-for="i in 5" :key="i" :value="i">{{ i }}</option>
                    <option>6+</option>
                </select>

                <select 
                    :id="filterForm.baths"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                >
                    <option :value="null">Baths</option>
                    <option v-for="i in 5" :key="i" :value="i">{{ i }}</option>
                    <option>6+</option>
                </select>
            </div>

            <div class="flex flex-nowrap items-center">
                <DefaultInput :form="filterForm" content="{{filterForm.areaFrom}}" placeholder="Area from" change-round="l" />
                <DefaultInput :form="filterForm" content="{{filterForm.areaTo}}" placeholder="Area to" change-round="r" />
            </div>

            <div class="flex flex-nowrap items-center">
                <button type="reset" class="btn-secondary">Reset</button>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>