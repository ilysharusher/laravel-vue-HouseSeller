<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    unreadNotifications: Object,
});
</script>

<template>
    <Link
        class="flex gap-2"
        :class="{
            'btn-red' : unreadNotifications.length,
            'btn-secondary': !unreadNotifications.length
        }"
        :href="route('notification.index')"
    >
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
            <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
        </svg>
        <span v-show="unreadNotifications.length">{{ unreadNotifications.length }}</span>
    </Link>
</template>

<style scoped>

</style>
