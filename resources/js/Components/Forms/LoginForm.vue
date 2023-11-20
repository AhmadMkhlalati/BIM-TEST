<template>
    <div>
        <v-form @submit.prevent="login">
            <v-col>
                <Input
                        label="Email Address"
                        type="text"
                        :model="form.email"
                        :errorMessages="form.errors.email"
                        @changeValue="
            (val) => {
              form.email = val;
            }
          "
                        required
                ></Input>
                <Input
                        type="password"
                        label="Password"
                        hint="At least 6 characters"
                        required
                        :model="form.password"
                        :errorMessages="form.errors.password"
                        @changeValue="
            (val) => {
              form.password = val;
            }
          "
                ></Input>
            </v-col>
            <v-col class="d-flex justify-space-between">
                <Button
                        color="blue darken-1"
                        type="submit"
                        label="Login"
                >
                </Button>
            </v-col>
        </v-form>
    </div>
</template>
<script>
import { useForm } from '@inertiajs/vue2'

    export default {
        props: {
            api: String,
        },
        data() {
            return {
                form: useForm({
                    email: null,
                    password: null,
                }),
            }
        },
        methods: {
            login() {
                console.log(this.form);
                if (this.form.email &&this.form.password) {
                    let formdata = new FormData();
                    for (let f in this.form) {
                        formdata.append(f, this.form[f]);
                    }

                    this.$store.dispatch("login", {

                        api: this.api,
                        form: formdata,
                    });
                } else {
                    this.$toast.error("please complet all fields");
                }
            },
        },
    };
</script>
