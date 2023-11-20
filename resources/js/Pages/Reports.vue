<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="items"
            :items-per-page="5"
            class="elevation-1"
            :loading="loading"
        >
            <template v-slot:top>
                <v-text-field
                    v-model="form.started_date"
                    outlined
                    label="started date"
                    class="mx-4"
                    type="date"
                ></v-text-field>
                <v-text-field
                    v-model="form.ended_date"
                    outlined
                    label="ended date"
                    class="mx-4"
                    type="date"
                ></v-text-field>
            </template>

        </v-data-table>
    </div>

</template>
<script>
import { router } from '@inertiajs/vue2'
import axios from "axios";

export default {
    data () {
        return {
            form: {
                started_date: null,
                ended_date: null,
            },
            items:[],
            loading:false,
            headers: [
                {
                    text: 'month',
                    value: 'month',
                },
                {
                    text: 'year',
                    value: 'year',
                },
                {
                    text: 'paid',
                    value: 'paid',
                },
                {
                    text: 'outstanding',
                    value: 'outstanding',
                },
                {
                    text: 'overdue',
                    value: 'overdue',
                },

            ],
        }
    },
    watch: {
        form: {
            handler(newForm, oldForm) {
                if(newForm.ended_date && newForm.started_date) {
                    var _this = this;
                    this.loading = true;
                    axios.get('/generateMonthlyReport', {params: this.form}).then(res => {
                        _this.items = res.data
                        _this.loading = false;

                    })
                }
                },
            deep: true
        }
    }
}
</script>
