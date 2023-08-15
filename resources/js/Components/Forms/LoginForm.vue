<script setup>
import {Link} from '@inertiajs/vue3';
import DefaultInput from '@/Components/Forms/Inputs/DefaultInput.vue';

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
            <div>
                <DefaultInput :form="form" label="Your Email" content="email" placeholder="example@example.com" />
            </div>
            <div class="my-4">
                <DefaultInput :form="form" label="Your Password" content="password" type="password" placeholder="Your password" />
            </div>
            <div>
                <button type="submit" class="btn-primary w-full">Login</button>
                <Link :href="route('register')" method="get" as="button" class="btn-secondary w-full">Don't have an account ?</Link>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
