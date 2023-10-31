<script setup>
import {Link} from '@inertiajs/vue3';
import DefaultInput from '@/Components/Forms/Inputs/DefaultInput.vue';
import Box from '@/Components/UI/Box.vue';

defineProps({
    form: Object,
});

defineEmits({
    submit: () => true,
});
</script>

<template>
    <Box class="xl:w-1/2 lg:w-2/3 mx-auto">
        <form @submit.prevent="$emit('submit')">
            <div>
                <div>
                    <DefaultInput :form="form" label="Your Email" content="email" placeholder="example@example.com" />
                </div>
                <div class="my-4">
                    <DefaultInput :form="form" label="Your Password" content="password" type="password" placeholder="Your password" />
                    <div>
                        <Link :href="route('password.request')" method="get" class="block mb-2 ml-3 text-sm font-medium text-blue-500 dark:text-blue-500 mt-3">Forgot password ?</Link>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn-primary w-full">Login</button>
                    <Link :href="route('register')" method="get" as="button" class="btn-secondary w-full">Don't have an account ?</Link>
                </div>
            </div>
        </form>
    </Box>
</template>

<style scoped>

</style>
