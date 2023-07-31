<script setup>
import { useForm } from '@inertiajs/vue3';

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

const submit = () => form.post('/listing');
</script>

<template>
    <form @submit.prevent="submit">
        <div>
            <div>
                <label>Beds</label>
                <input v-model.number="form.beds" type="text" />
                <div v-if="form.errors.beds" class="error">
                    {{ form.errors.beds }}
                </div>
            </div>

            <div>
                <label>Baths</label>
                <input v-model.number="form.baths" type="text" />
                <div v-if="form.errors.baths" class="error">
                    {{ form.errors.baths }}
                </div>
            </div>

            <div>
                <label>Area</label>
                <input v-model.number="form.area" type="text" />
                <div v-if="form.errors.area" class="error">
                    {{ form.errors.area }}
                </div>
            </div>

            <div>
                <label>City</label>
                <input v-model="form.city" type="text" />
                <div v-if="form.errors.city" class="error">
                    {{ form.errors.city }}
                </div>
            </div>

            <div>
                <label>Post Code</label>
                <input v-model="form.code" type="text" />
                <div v-if="form.errors.code" class="error">
                    {{ form.errors.code }}
                </div>
            </div>

            <div>
                <label>Street</label>
                <input v-model="form.street" type="text" />
                <div v-if="form.errors.street" class="error">
                    {{ form.errors.street }}
                </div>
            </div>

            <div>
                <label>Street Nr</label>
                <input v-model="form.street_number" type="text" />
                <div v-if="form.errors.street_number" class="error">
                    {{ form.errors.street_number }}
                </div>
            </div>

            <div>
                <label>Price</label>
                <input v-model.number="form.price" type="text" />
                <div v-if="form.errors.price" class="error">
                    {{ form.errors.price }}
                </div>
            </div>

            <div>
                <button type="submit">Create</button>
            </div>
        </div>
    </form>
</template>

<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px
}
</style>