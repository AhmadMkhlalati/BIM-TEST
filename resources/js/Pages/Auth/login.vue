<template>
    <v-app>
        <div class="container_login" >
            <v-row no-gutters>
                <v-col cols="7" class="main-part d-none d-md-none d-lg-flex">
                    <div class="d-flex">
                        <p>BIM Admin</p>
                    </div>
                </v-col>
                <v-col
                    cols="12"
                    lg="5"
                    class="login-part d-flex align-center justify-center"
                >
                    <v-row no-gutters class="align-start">
                        <v-col
                            cols="12"
                            class="login-part d-flex align-center justify-center flex-column"
                        >
                            <div class="login-wrapper pt-md-4 pt-0">
                                <v-form>
                                    <v-container>
                                        <v-row class="flex-column">
                                            <v-col>
                                                <p
                                                    class="login-slogan display-2 text-center font-weight-medium my-10"
                                                >
                                                    Good Morning, User
                                                </p>
                                            </v-col>
                                            <v-col cols="12" class="d-flex align-center my-3">
                                                <v-divider></v-divider>
                                            </v-col>
                                            <LoginForm :api="api"></LoginForm>
                                        </v-row>
                                    </v-container>
                                </v-form>
                            </div>
                        </v-col>
                        <v-col cols="12" class="d-flex justify-center">
                            <v-footer>
                                <div class="primary--text">
                                    © 2023
                                    <a href="#" class="text-decoration-none"
                                    >BIM</a
                                    >, LLC. All rights reserved.
                                </div>
                            </v-footer>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </div>
    </v-app>
</template>

<script>
import './Login.scss'
export default {
    layout:null,
    name: "Login",
    data() {
        return {
            api: "login",
            form: {
                email: '',
                password: ''
            }

        };
    },
    methods: {},

}
</script>

<!--<style src="" lang="scss" />-->

