<template>
    <v-container fluid class="icons-page">
        <v-row no-gutters class="d-flex justify-space-between mt-2 mb-2">
            <v-col>
                <!-- List -->
                <Table
                    newItemLabel="Payments"
                    :title="title"
                    :api="api"
                    :create="create"
                    :del="del"
                    :edit="edit"
                    :headers="headers"
                    @openForm="setForm"
                    @update_page="(val )=>{page = val}"

                ></Table>
                <!-- Form -->
            </v-col>
        </v-row>
        <v-dialog v-model="dialog_form" max-width="500px">
            <PaymentForm
                v-if="dialog_form"
                newItemLabel="Payment"
                :isNew="isNew"
                :api="api"
                :id="id"
                :page="page"
                @dialogForm="dialog_form = false"
            ></PaymentForm>
        </v-dialog>
    </v-container>
</template>

<script>
import { mapActions } from "vuex";
import { useForm } from "@inertiajs/vue2";

export default {
    data() {
        return {
            isNew: true,
            dialog_form: false,
            page:1,
            api: {
                getAll: "/payment/fetch",
                edit: "payment/",
                delete: "payment",
            },
            create: false,
            del: true,
            edit: true,
            title: "Payment",
            id:null,
            headers: [
                {
                    text: "#",
                    align: "start",
                    sortable: true,
                    value: "id",
                },

                {
                    text: "amount",
                    value: "amount",
                    sortable: true,
                },
                {
                    text: "transaction",
                    value: "transaction_id",
                    sortable: true,
                },
                {
                    text: "paid_on",
                    value: "paid_on",
                },
                {
                    text: "details",
                    value: "details",
                },

                {
                    text: "created_at",
                    value: "created_at",
                },
                {
                    text: "actions",
                    value: "actions",
                },]
        };
    },
    methods: {
        ...mapActions(["initForm"]),

        async setForm(val) {
            let form = {
                amount: null,
                paid_on: null,
                details: null,
                transaction_id: null,
            };

            this.$store.dispatch("initForm", form);
            if (val != null) {
                this.id = val.id
                this.isNew = false;
                this.$store.dispatch("setForm", val);
            } else {
                this.isNew = true;
            }
            this.dialog_form = true;
        },
    },
};
</script>
