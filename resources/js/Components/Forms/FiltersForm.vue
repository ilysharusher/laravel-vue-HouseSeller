<script setup>
import DefaultInput from '@/Components/Forms/Inputs/DefaultInput.vue';

defineProps({
    filterForm: Object,
});

defineEmits({
    submit: () => true,
    reset: () => true,
});
</script>

<template>
    <form @submit.prevent="$emit('submit')">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <DefaultInput :form="filterForm" content="priceFrom" placeholder="Price from" change-round="l" class="max-w-[100px]" />
                <DefaultInput :form="filterForm" content="priceTo" placeholder="Price to" change-round="r" class="max-w-[100px]" />
            </div>

            <div class="flex flex-nowrap items-center">
                <select
                    v-model="filterForm.beds"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500 min-w-[100px]"
                >
                    <option :value="null">Beds</option>
                    <option v-for="i in 5" :key="i" :value="i">{{ i }}</option>
                    <option>6+</option>
                </select>

                <select
                    v-model="filterForm.baths"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500 min-w-[100px]"
                >
                    <option :value="null">Baths</option>
                    <option v-for="i in 5" :key="i" :value="i">{{ i }}</option>
                    <option>6+</option>
                </select>
            </div>

            <div class="flex flex-nowrap items-center">
                <DefaultInput :form="filterForm" content="areaFrom" placeholder="Area from" change-round="l" class="max-w-[100px]" />
                <DefaultInput :form="filterForm" content="areaTo" placeholder="Area to" change-round="r" class="max-w-[100px]" />
            </div>

            <button type="submit" class="btn-primary max-w-[100px]">Filter</button>
            <button type="reset" class="btn-secondary max-w-[100px]" @click="$emit('reset')">Reset</button>
        </div>
    </form>
</template>

<style scoped>

</style>