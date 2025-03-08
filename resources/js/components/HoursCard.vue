<script setup>
import { router } from '@inertiajs/vue3'
const props = defineProps(['item'])


function update() {
    router.put('/business-hours/update', props.item, {
        onSuccess: (res) => {
            alert('Saved')
        },
        onError: (e) => {
            alert('Error update')
        }
    })
}
</script>

<template>
    <div>
        <v-card class="my-2">
            <v-form @submit.prevent="update">
                <v-container>
                    <v-row>
                        <v-col class="d-flex justify-start align-center">
                            <v-checkbox :label="item.name" v-model="item.is_open"></v-checkbox>
                        </v-col>
                        <v-col>
                            <v-row>
                                <v-col class="d-flex flex-row ga-13">
                                    <div>
                                        <label>Open At</label>
                                        <input class="time-picker" :disabled="!item.is_open" v-model="item.open_at"
                                            type="time" name="openAt" min="06:00" max="16:00" required />
                                    </div>
                                    <div>
                                        <label>Close At</label>
                                        <input class="time-picker" :disabled="!item.is_open" v-model="item.close_at"
                                            type="time" name="closeAt" min="06:00" max="16:00" required />
                                    </div>
                                </v-col>
                                <v-col class="d-flex flex-row ga-13">
                                    <div>
                                        <label>Lunch Start</label>
                                        <input class="time-picker" :disabled="!item.is_open" v-model="item.lunch_start"
                                            type="time" name="openAt" min="06:00" max="16:00" required />
                                    </div>
                                    <div>
                                        <label>Lunch End</label>
                                        <input class="time-picker" :disabled="!item.is_open" v-model="item.lunch_end"
                                            type="time" name="closeAt" min="06:00" max="16:00" required />
                                    </div>
                                </v-col>
                            </v-row>
                        </v-col>
                        <v-col class="d-flex flex-column align-end">
                            <div>
                                <v-checkbox label="Every other week" :disabled="!item.is_open"
                                    v-model="item.is_every_other_week"></v-checkbox>
                            </div>
                            <div>
                                <label>Start day</label>
                                <br>
                                <input class="time-picker" :disabled="!item.is_every_other_week || !item.is_open"
                                    type="date" name="start-date" v-model="item.start_date" />
                            </div>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="d-flex flex-column align-end">
                            <v-btn type="submit">Update</v-btn>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </v-card>
    </div>
</template>


<style scoped>
.time-picker {
    border: 1px solid #ccc;
}
</style>