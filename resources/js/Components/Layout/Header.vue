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
                    <Link :href="route('realtor.listing.index')" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        {{ user.name }}
                    </Link>
                    <Link :href="route('listing.create')" class="btn-primary">+ New Listing</Link>
                    <Link :href="route('logout')" method="post" as="button" class="btn-red">Logout</Link>
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
