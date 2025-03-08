<script setup>
import { ref } from 'vue'
import { router, useForm } from '@inertiajs/vue3'

const visible = ref(false)
const form = useForm({
    email: null,
    password: null,
})

function login() {
    router.post('/login', form, {
        onSuccess: (res) => {
            form.clearErrors()
        },
        onError: (e) => {
            form.setError(
                'email', e.email
            );
        }
    })
}
</script>

<template>
    <div>
        <v-form @submit.prevent="login">
            <v-card class="mx-auto mt-16 pa-12 pb-8" elevation="8" max-width="448" rounded="lg">
                <div class="text-h3 text-center mb-4">Login</div>
                <div class="text-subtitle-1 text-medium-emphasis">Email</div>

                <v-text-field density="compact" placeholder="Email address" variant="outlined"
                    v-model="form.email"></v-text-field>

                <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
                    Password
                </div>

                <v-text-field :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'" density="compact" placeholder="Enter your password"
                    variant="outlined" @click:append-inner="visible = !visible" v-model="form.password"></v-text-field>

                <div v-if="form.errors.email" class="error-text my-2">{{ form.errors.email }}</div>

                <v-btn type="submit" class="mb-8" color="blue" size="large" variant="tonal" block>
                    Log In
                </v-btn>
            </v-card>
        </v-form>
    </div>
</template>


<style scoped>
.error-text {
    color: red;
}
</style>