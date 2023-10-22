<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    notification: Object,
});
</script>

<template>
    <Link
        v-if="!notification.read_at"
        :href="route('mark.notification.as.read', notification.id)"
        method="patch"
        class="btn-secondary flex items-center justify-center mt-5 lg:mt-0"
    >
        Mark as read
    </Link>
</template>

<style scoped>

</style>
