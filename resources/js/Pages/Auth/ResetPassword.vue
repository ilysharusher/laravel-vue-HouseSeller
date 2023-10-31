<script setup>
import ResetPasswordForm from '@/Components/Forms/ResetPasswordForm.vue';
import {useForm} from '@inertiajs/vue3';

const props = defineProps({
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: null,
    password: null,
    password_confirmation: null,
});

const submit = () => form.post(route('password.update'));
</script>

<template>
    <ResetPasswordForm :form="form" @submit="submit" />
</template>

<style scoped>

</style>
