<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/Errors/InputError.vue';

const form = useForm({
    email: null,
    password: null,
});

const submit = () => form.post(route('login.store'));
</script>

<template>
    <form @submit.prevent="submit">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email">Your Email</label>
                <input id="email" v-model="form.email" type="text" class="input" />
                <InputError :error-message="form.errors.email" />
            </div>
            <div class="my-4">
                <label for="password">Your Password</label>
                <input id="password" v-model="form.password" type="password" class="input" />
                <InputError :error-message="form.errors.password" />
            </div>
            <div>
                <button type="submit" class="btn-primary w-full">Login</button>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
