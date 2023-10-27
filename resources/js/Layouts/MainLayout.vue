<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Header from '@/Components/Layout/Header.vue';
import Footer from '@/Components/Layout/Footer.vue';
import SuccessAlert from '@/Components/Alerts/SuccessAlert.vue';
import UnsuccessAlert from '@/Components/Alerts/UnsuccessAlert.vue';
import InfoAlert from '@/Components/Alerts/InfoAlert.vue';

const flashSuccess = computed(
    () => usePage().props.flash.success,
);

const flashUnsuccess = computed(
    () => usePage().props.flash.unsuccess,
);

const flashInfo = computed(
    () => usePage().props.flash.info,
);
</script>

<template>
    <Header />
    <main class="container mx-auto p-4 w-full">
        <SuccessAlert v-if="flashSuccess" :flash-success="flashSuccess" />
        <UnsuccessAlert v-if="flashUnsuccess" :flash-unsuccess="flashUnsuccess" />
        <InfoAlert v-if="flashInfo" :flash-info="flashInfo" />
        <slot />
    </main>
<!--    <Footer /> // it looks like so bad  -->
</template>

<style scoped></style>
