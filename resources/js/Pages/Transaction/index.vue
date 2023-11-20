<template>
    <v-container fluid class="icons-page">
        <v-row no-gutters class="d-flex justify-space-between mt-2 mb-2">
            <v-col>
                <!-- List -->
                <Table
                    newItemLabel="Transactions"
                    :title="title"
                    :api="api"
                    :create="create"
                    :del="del"
                    :edit="edit"
                    :show="show"
                    :payment="payment"
                    :headers="headers"
                    @openForm="setForm"
                    @openFormPayment="setFormPayment"
                    @update_page="(val )=>{page = val}"

                ></Table>
                <!-- Form -->
            </v-col>
        </v-row>
        <v-dialog v-model="dialog_form" max-width="500px">
            <TransactionForm
                v-if="dialog_form"
                newItemLabel="Transaction"
                :isNew="isNew"
                :api="api"
                :id="id"
                :page="page"
                @dialogForm="dialog_form=false"
            ></TransactionForm>
        </v-dialog>
        <v-dialog v-model="dialog_payment_form" max-width="500px">
            <PaymentForm
                newItemLabel="Payment"
                :isNew="isNew"
                :api="api_payment"
                :id="id"
                :page="page"
                @dialogForm="dialog_payment_form = false"
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

            page:1,
            isNew: true,
            dialog_form: false,
            dialog_payment_form: false,
            api: {
                getAll: "/transaction/fetch",
                edit: "transaction/",
                create: "transaction",
                delete: "transaction",
                show: "transaction/",
            },
            api_payment: {
                getAll: "/transaction/fetch",
                edit: "payment",
                create: "payment",
                delete: "payment",
                show: "payment/",
            },
            create: true,
            del: true,
            edit: true,
            show: true,
            payment: true,
            title: "Transaction",
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
                    text: "status",
                    value: "status",
                    sortable: true,
                },
                {
                    text: "payer",
                    value: "user.name",
                },

                {
                    text: "due_on",
                    value: "due_on",
                },
                {
                    text: "vat",
                    value: "vat",
                },
                {
                    text: "is_vat_inclusive",
                    value: "is_vat_inclusive",
                },
                {
                    text: "created_at",
                    value: "created_at",
                },
                {
                    text: "actions",
                    value: "actions",
                },
                { text: '', value: 'data-table-expand' },

            ]
        };
    },
    methods: {
        ...mapActions(["initForm", "sendForm"]),

        async setFormPayment(val) {
            let form = {
                amount: null,
                paid_on: null,
                details: null,
                transaction_id: val.id,
            };

            this.$store.dispatch("initForm", form);

                this.isNew = true;

            this.dialog_payment_form = true;
        },
        async setForm(val) {
            let form = {
                amount: null,
                payer: null,
                due_on: null,
                vat: null,
                is_vat_inclusive: 0,
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
