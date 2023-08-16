<script setup>
import {Link, usePage} from '@inertiajs/vue3';
import {computed} from 'vue';

const user = computed(
    () => usePage().props.auth.user,
);
</script>

<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div class="text-xl text-blue-700 dark:text-blue-300 font-bold text-center">
                    <Link :href="route('listing.index')">HouseSeller</Link>
                </div>
                <div v-if="user" class="flex items-center gap-4">
                    <div class="text-sm text-gray-500 px-5">
                        {{ user.name }}
                    </div>
                    <Link :href="route('listing.create')" class="btn-primary">+ New Listing</Link>
                    <Link :href="route('logout')" method="post" as="button" class="btn-secondary">Logout</Link>
                </div>
                <div v-else>
                    <Link :href="route('login')" class="btn-primary">Login or Register</Link>
                </div>
            </nav>
        </div>
    </header>
</template>

<style scoped>

</style>
