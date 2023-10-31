<script setup>
import Box from '@/Components/UI/Box.vue';
import DefaultInput from '@/Components/Forms/Inputs/DefaultInput.vue';

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
                <div class="my-4">
                    <DefaultInput :form="form" label="Your Email" content="email" type="email" placeholder="example@example.com" />
                </div>
                <div class="my-4">
                    <DefaultInput :form="form" label="New Password" content="password" type="password" placeholder="Your password" />
                </div>
                <div class="my-4">
                    <DefaultInput :form="form" label="Confirm New Password" content="password_confirmation" type="password" placeholder="Confirm Your password" />
                </div>
                <div>
                    <button type="submit" class="btn-primary w-full">Reset Password</button>
                </div>
            </div>
        </form>
    </Box>
</template>

<style scoped>

</style>
