<script setup>
import { useForm } from '@inertiajs/vue3';
import RegisterForm from '@/Components/Forms/RegisterForm.vue';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const submit = () => form.post(route('register.store'));
</script>

<template>
    <RegisterForm :form="form" @submit="submit" />
</template>

<style scoped>

</style>
