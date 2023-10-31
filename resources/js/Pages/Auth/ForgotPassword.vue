<script setup>
import ForgotPasswordForm from '@/Components/Forms/ForgotPasswordForm.vue';
import {useForm} from '@inertiajs/vue3';

const form = useForm({
    email: null,
});

const submit = () => form.post(route('password.email'));
</script>

<template>
    <ForgotPasswordForm :form="form" @submit="submit" />
</template>

<style scoped>

</style>
