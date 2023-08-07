<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/Errors/InputError.vue';

const form = useForm({
    area: null,
    beds: null,
    baths: null,
    city: null,
    street: null,
    street_number: null,
    code: null,
    price: null,
});

const submit = () => form.post(route('listing.store'));
</script>

<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input v-model.number="form.beds" type="text" class="input" />
                <InputError v-if="form.errors.beds" :error-message="form.errors.beds" />
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input v-model.number="form.baths" type="text" class="input" />
                <InputError v-if="form.errors.baths" :error-message="form.errors.baths" />
            </div>

            <div class="col-span-2">
                <label class="label">Area</label>
                <input v-model.number="form.area" type="text" class="input" />
                <InputError v-if="form.errors.area" :error-message="form.errors.area" />
            </div>

            <div class="col-span-4">
                <label class="label">City</label>
                <input v-model="form.city" type="text" class="input" />
                <InputError v-if="form.errors.city" :error-message="form.errors.city" />
            </div>

            <div class="col-span-2">
                <label class="label">Post Code</label>
                <input v-model="form.code" type="text" class="input" />
                <InputError v-if="form.errors.code" :error-message="form.errors.code" />
            </div>

            <div class="col-span-4">
                <label class="label">Street</label>
                <input v-model="form.street" type="text" class="input" />
                <InputError v-if="form.errors.street" :error-message="form.errors.street" />
            </div>

            <div class="col-span-2">
                <label class="label">Street Nr</label>
                <input v-model="form.street_number" type="text" class="input" />
                <div v-if="form.errors.street_number" class="input-error">
                    {{ form.errors.street_number }}
                </div>
                <InputError v-if="form.errors.street_number" :error-message="form.errors.street_number" />
            </div>

            <div class="col-span-6">
                <label class="label">Price</label>
                <input v-model.number="form.price" type="text" class="input" />
                <InputError v-if="form.errors.price" :error-message="form.errors.price" />
            </div>

            <div class="col-span-6">
                <button type="submit" class="btn-primary">Create</button>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>