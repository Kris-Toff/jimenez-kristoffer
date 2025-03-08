<script setup>
import StatusCard from '../components/StatusCard.vue';
import Checker from '../components/Checker.vue';
const props = defineProps(['status'])
</script>

<template>
    <v-container>
        <v-row class="text-center my-16">
            <v-col>
                <p class="text-h3">Welcome to Amy and Dave's Bakery</p>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <status-card class="mx-auto text-center" :status="status"></status-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <checker class="mx-auto text-center"></checker>
            </v-col>
        </v-row>
    </v-container>
</template>


<style scoped></style>