<script setup>
import { watch, ref } from 'vue';
import axios from 'axios';
import { useDateFormatting } from '../composables/useDateFormatting';

const status = ref([])
const dateChecker = ref(null)
const showMsg = ref(false)

const { humanizeDay } = useDateFormatting();

function check() {
    axios.get('/api/bakery-status', {
        params: {
            date: dateChecker.value
        }
    })
        .then(function (response) {
            showMsg.value = true
            status.value = response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
}

watch(dateChecker, (p, n) => {
    showMsg.value = false
})
</script>

<template>
    <v-card max-width="500" class="pa-6">
        <v-form @submit.prevent="check">
            <p class="text-h5">Check if we are open: </p>
            <br>
            <input class="date-picker" v-model="dateChecker" type="date" name="date-checker" />
            <br>
            <v-btn type="submit">Check</v-btn>
            <br>
            <div v-if="showMsg">
                <p class="mt-10">We are {{ status.is_open ? 'OPEN' : 'CLOSE' }}</p>
                <p class="mt-1" v-if="!status.is_open">We will be open: {{ humanizeDay(dateChecker,
                    status.next_open_date) }}
                </p>
            </div>
        </v-form>
    </v-card>
</template>


<style scoped>
.date-picker {
    border: 1px solid #ccc;
    margin-bottom: 10px;
}
</style>