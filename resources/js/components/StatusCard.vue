<script setup>
import dayjs from 'dayjs'
import { useDateFormatting } from '../composables/useDateFormatting'
import { onMounted } from 'vue'

const props = defineProps(['status'])
const { dayDateTimeString, humanizeDay } = useDateFormatting()

onMounted(() => {
    if (props.status.next_open_date)
        setInterval(() => {
            timeChecker()
        }, 1000)
})

function timeChecker() {
    const now = dayjs()
    const diffTime = dayjs(props.status.next_open_date).diff(now, "minute")

    if (diffTime <= 0) {
        props.status.is_open = true
        props.status.show_datetime = false
        props.status.next_open_date = null
    }
}
</script>

<template>
    <v-card max-width="500" class="pa-6" :class="{ 'open-card': status.is_open, 'close-card': !status.is_open }">
        <p class="text-h3 pt-6">The bakery is {{ status.is_open ? "OPEN" : "CLOSE" }}</p>
        <br>
        <p v-if="!status.is_open && status.show_datetime">We'll be back in: {{
            dayDateTimeString(status.next_open_date) }}</p>
        <p v-if="!status.is_open && !status.show_datetime">Next opening: {{ humanizeDay(now, status.next_open_date) }}
        </p>
    </v-card>
</template>


<style scoped>
.open-card {
    background-color: rgb(187, 255, 187);
}

.close-card {
    background-color: rgb(255, 187, 187);
}
</style>