<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    message: String,
})
</script>

<template>
    <div>
        <h1>Props say: {{ message }}</h1>
        <Link href='/show'>goto Show</Link>
    </div>
</template>

<style scoped>

</style>