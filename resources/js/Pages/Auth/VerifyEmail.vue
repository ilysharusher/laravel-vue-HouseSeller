<script setup>
import { Link } from '@inertiajs/vue3';
import EmptyPlace from '@/Components/UI/EmptyPlace.vue';
</script>

<template>
    <EmptyPlace>
        <div>
            <p>Oops! It looks like you haven't verified your email yet :(</p>
            <Link
                :href="route('verification.send')"
                method="post"
                class="text-blue-500"
            >
                But you can receive a new verification link!
            </Link>
        </div>
    </EmptyPlace>
</template>

<style scoped>

</style>
