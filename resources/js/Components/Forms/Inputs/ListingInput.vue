<script setup>
import InputError from '@/Components/Errors/InputError.vue';

defineProps({
    form: Object,
    label: String,
    content: String,
});
</script>

<template>
    <div>
        <label class="label">{{ label }}</label>
        <input v-model="form[content]" type="text" class="input" />
        <InputError v-if="form.errors[content]" :error-message="form.errors[content]" />
    </div>
</template>

<style scoped>

</style>