<script setup>
import {Link} from '@inertiajs/vue3';

/*defineProps({
    unreadNotifications: Object,
});*/
</script>

<template>
    <Link
        class="flex gap-2 btn-secondary"
        :href="route('message.index')"
    >
        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h9M5 9h5m8-8H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4l3.5 4 3.5-4h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
        </svg>
        <!--        <span v-show="unreadNotifications.length">{{ unreadNotifications.length }}</span>-->
    </Link>
</template>

<style scoped>

</style>
