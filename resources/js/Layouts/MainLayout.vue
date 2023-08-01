<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const flashSuccess = computed(
    () => usePage().props.flash.success,
);
</script>

<template>
    <Link :href="route('listing.index')">Listings</Link>
    |
    <Link :href="route('listing.create')">Create Listing</Link>
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