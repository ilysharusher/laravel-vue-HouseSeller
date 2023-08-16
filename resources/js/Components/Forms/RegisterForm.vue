<script setup>
import DefaultInput from '@/Components/Forms/Inputs/DefaultInput.vue';
import {Link} from '@inertiajs/vue3';

defineProps({
    form: Object,
});

defineEmits({
    submit: () => true,
});
</script>

<template>
    <form @submit.prevent="$emit('submit')">
        <div class="w-1/2 mx-auto">
            <div class="my-4">
                <DefaultInput :form="form" label="Your Name" content="name" placeholder="Petya" />
            </div>
            <div class="my-4">
                <DefaultInput :form="form" label="Your Email" content="email" type="email" placeholder="example@example.com" />
            </div>
            <div class="my-4">
                <DefaultInput :form="form" label="Your Password" content="password" type="password" placeholder="Your password" />
            </div>
            <div class="my-4">
                <DefaultInput :form="form" label="Confirm Password" content="password_confirmation" type="password" placeholder="Confirm Your password" />
            </div>
            <div>
                <button type="submit" class="btn-primary w-full">Register</button>
                <Link :href="route('login')" method="get" as="button" class="btn-secondary w-full">Already have an account ?</Link>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
