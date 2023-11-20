<template>
    <v-form @submit.prevent="save">
        <v-card>
            <v-toolbar dark color="primary">{{ formTitle }}</v-toolbar>
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <Input
                            label="Amount"
                            type="number"
                            :model="form.amount"
                            :errorMessages="errors.amount"
                            @changeValue="val => (form.amount = val)"
                            required
                        ></Input>
                    </v-col>

                    <v-col cols="12">
                        <Date
                            label="Paid on"
                            required
                            :model="form.paid_on"
                            :errorMessages="errors.paid_on"
                            @changeValue="val => (form.paid_on = val)"
                        ></Date>
                    </v-col>
                    <v-col cols="12">
            <TextArea
                label="Details"
                :model="form.details"
                :errorMessages="errors.details"
                @changeValue="val => (form.details = val)"
                required
            ></TextArea>
                    </v-col>
                    <v-col cols="12" class="d-flex justify-space-between">
                        <Button color="blue darken-1" type="submit" label="save"></Button>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </v-form>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    props: {
        api: Object,
        isNew: Boolean,
        newItemLabel: String,
        id: String,
        page:{
            default:1
        },
    },

    computed: {
        ...mapGetters(["getForm",'getError']),

        formTitle() {
            return (this.isNew ? " Create " : " Edit ") + this.newItemLabel;
        },
        form() {
            return this.getForm;
        },
        errors() {
            return this.getError;
        },
    },

    methods: {

        async save() {
            let formdata = new FormData();
            for (let f in this.form) {
                formdata.append(f, this.form[f]);
            }
            if (!this.isNew) {
                this.form["_method"]= "PUT";
            }
            this.$store.dispatch("sendForm", {
                api: this.api,
                form: this.form,
                isNew: this.isNew,
                id:this.id,
                page:this.page
            });
            this.$emit("dialogForm", false);
        },
    },
};
</script>
