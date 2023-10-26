<script setup>
import InputError from '@/Components/Errors/InputError.vue';

defineProps({
    form: Object,
    content: {
        type: String,
        default: null,
    },
    label: {
        type: String,
        default: null,
    },
    type: {
        type: String,
        default: 'text',
    },
    placeholder: {
        type: String,
        default: null,
    },
    changeRound: {
        type: String,
        default: null,
    },
});
</script>

<template>
    <div>
        <label v-if="label" :for="content" class="block mb-2 ml-3 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
        <input
            :id="content"
            v-model="form[content]"
            :type="type"
            :class="{
                'rounded-l-xl': changeRound === 'l',
                'rounded-r-xl': changeRound === 'r',
                'rounded-xl': changeRound === null,
            }"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            :placeholder="placeholder"
        >
        <InputError v-if="form.errors[content]" :error-message="form.errors[content]" />
    </div>
</template>

<style scoped>

</style>
