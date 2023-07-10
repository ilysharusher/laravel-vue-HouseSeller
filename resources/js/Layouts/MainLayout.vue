<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    Links:
    <Link href='/'>goto Index</Link>
    |
    <Link href='/show'>goto Show</Link>
    <slot />
</template>

<style scoped>

</style>