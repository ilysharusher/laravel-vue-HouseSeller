<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                    <Link :href="route('listing.index')">HouseSeller</Link>
                </div>
                <div class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md">
                    <Link :href="route('listing.create')">+ New Listing</Link>
                </div>
            </nav>
        </div>
    </header>
</template>

<style scoped>

</style>