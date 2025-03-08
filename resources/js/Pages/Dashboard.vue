<script setup>
import { router } from '@inertiajs/vue3'
import HoursCard from '../components/HoursCard.vue'

const props = defineProps(['business_hours'])

function logout() {
    router.get('/logout')
}
</script>

<template>
    <div>
        <v-toolbar title="Dashboard">
            <v-btn icon="mdi-power" title="Logout" @click="logout"></v-btn>
        </v-toolbar>

        <v-container>
            <v-row>
                <v-col cols="6" sm="12" md="6" class="mx-auto pa-12 pb-8">
                    <hours-card v-for="hr in business_hours" :key="hr.id" :item="hr"></hours-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>


<style scoped>
.bg-grey {
    background-color: rgb(182, 182, 182);
}
</style>