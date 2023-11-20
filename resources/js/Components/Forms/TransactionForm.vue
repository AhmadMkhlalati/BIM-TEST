<template>
    <v-form @submit.prevent="save">
        <v-card>
                <v-toolbar dark color="primary">{{formTitle}}</v-toolbar>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <AutoComplete
                                label="User"
                                api="/users_search"
                                :model="form.payer"
                                :errorMessages="errors.payer"
                                @changeValue="
            (val) => {
              form.payer = val;
            }
          "
                                required
                            ></AutoComplete>
                        </v-col>
                        <v-col cols="12">
                            <Input
                                label="Amount"
                                type="number"
                                :model="form.amount"
                                :errorMessages="errors.amount"
                                @changeValue="
            (val) => {
              form.amount = val;
            }
          "
                                required
                            ></Input>
                        </v-col>
                        <v-col cols="12">

                            <Input
                                type="number"
                                label="Vat"
                                required
                                :model="form.vat"
                                :errorMessages="errors.vat"
                                @changeValue="
            (val) => {
              form.vat = val;
            }
          "
                            ></Input>
                        </v-col>
                        <v-col cols="12">
                            <Date
                                label="Due on"
                                required
                                :model="form.due_on"
                                :errorMessages="errors.due_on"
                                @changeValue="
            (val) => {
              form.due_on = val;
            }
          "
                            ></Date>
                        </v-col>
                        <v-col cols="12">
                            <Switcher
                                label="Is Vat Inclusive"
                                required
                                :model="form.is_vat_inclusive"
                                :errorMessages="errors.is_vat_inclusive"
                                @switcher="
            (val) => {
              form.is_vat_inclusive = val;
            }
          "
                            ></Switcher>
                        </v-col>
                        <v-col cols="12" class="d-flex justify-space-between">
                            <Button
                                color="blue darken-1"
                                type="submit"
                                label="save"
                            >
                            </Button>
                        </v-col>
                    </v-row>
                </v-container>
        </v-card>
    </v-form>
</template>
<script>
import {mapGetters} from "vuex";

export default {
    props: {
        api: Object,
        isNew: Boolean,
        newItemLabel:String,
        form:Object,
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
    watch: {
        model() {
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
    },}
};
</script>
