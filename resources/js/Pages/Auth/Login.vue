<script setup>
import {useForm} from '@inertiajs/vue3';
import LoginForm from '@/Components/Forms/LoginForm.vue';

const form = useForm({
    email: null,
    password: null,
});

const submit = () => form.post(route('login.store'));
</script>

<template>
    <LoginForm :form="form" @submit="submit" />
</template>

<style scoped>

</style>
