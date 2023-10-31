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
                <div class="mt-4">
                    <button type="submit" class="btn-primary w-full">Send Password Reset Link</button>
                    <Link :href="route('login')" method="get" as="button" class="btn-secondary w-full">Remember password ?</Link>
                </div>
            </div>
        </form>
    </Box>
</template>

<style scoped>

</style>
