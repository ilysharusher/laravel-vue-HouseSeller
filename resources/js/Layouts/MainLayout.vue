<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const flashSuccess = computed(
    () => usePage().props.flash.success,
);
</script>

<template>
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <slot />
</template>

<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>