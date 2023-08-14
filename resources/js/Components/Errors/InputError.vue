<script setup>
defineProps({
    errorMessage: String,
});
</script>

<template>
    <div
        v-if="errorMessage"
        class="input-error"
    >
        {{ errorMessage }}
    </div>
</template>

<style scoped>

</style>
