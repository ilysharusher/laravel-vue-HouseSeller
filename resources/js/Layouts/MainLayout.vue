<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const timer = ref(100)

setInterval(() => {
    timer.value--
}, 1000)
</script>

<template>
  Links:
  <Link href="/">goto Index</Link>
  |
  <Link href="/show">goto Show</Link>
  <slot />
  <p>Timer: {{ timer }}</p>
</template>

<style scoped>

</style>