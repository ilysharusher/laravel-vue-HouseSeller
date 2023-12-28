<script setup>

import {Link} from '@inertiajs/vue3';

defineProps({
    listing: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Link
        as="button"
        class="btn-secondary w-full h-full"
    >
        Write to seller
    </Link>
</template>

<style scoped>

</style>
