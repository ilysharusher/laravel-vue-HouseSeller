<script setup>
import {Link} from '@inertiajs/vue3';
</script>

<template>
    <div>
        <h1>Verify Email</h1>
    </div>
    <div>
        <Link :href="route('verification.send')" method="post" as="button" class="btn-secondary">Resend link</Link>
    </div>
</template>

<style scoped>

</style>
