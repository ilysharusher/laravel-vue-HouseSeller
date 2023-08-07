<script setup>
defineProps({
    errorMessage: String,
});
</script>

<template>
    <div class="input-error">
        {{ errorMessage }}
    </div>
</template>

<style scoped>

</style>