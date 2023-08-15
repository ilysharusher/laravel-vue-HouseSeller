<script setup>
import InputError from '@/Components/Errors/InputError.vue';

defineProps({
    form: Object,
    label: String,
    content: String,
    type: {
        type: String,
        default: 'text',
    },
    placeholder: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <div>
        <label :for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
        <input
            :id="content"
            v-model="form[content]" :type="type"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            :placeholder="placeholder"
        >
        <InputError v-if="form.errors[content]" :error-message="form.errors[content]" />
    </div>
</template>

<style scoped>

</style>
