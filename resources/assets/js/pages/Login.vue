<template>
    <div>
        <v-container fluid>
            <v-row>
                <v-col cols="12" align="center" justify="center" class="grey lighten-5" style="height:80vh">
                    <v-card style="width: 500px" class="pa-5">
                        <h1 class="pb-4">Login page</h1>
                        <v-form @submit.prevent="handleLogin">
                            <v-text-field outlined label="Email address" v-model="form.email" type="email"
                                          required></v-text-field>
                            <v-text-field outlined label="Password" v-model="form.password" type="password"
                                          required></v-text-field>
                            <v-btn type="submit" large color="primary">Login</v-btn>
                        </v-form>
                        <v-alert type="error" v-if="onError" style="margin-top: 20px;">
                            Oop! Credentials are not found!
                        </v-alert>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import axios from "axios";
    import Token from "../Helpers/Token";
    import AppStorage from "../Helpers/AppStorage";

    export default {
        name: "Login",

        created() {
            if (User.loggedIn()) {
                this.$router.push({name: 'forum'});
            }
        },

        data() {
            return {
                form: {
                    email: 'cathryn81@example.net',
                    password: 'secret'
                },
                onError: false
            }
        },

        methods: {

            handleLogin() {
                axios.post('/api/auth/login', this.form).then(res => {
                    const access_token = res.data.access_token;
                    const user = res.data.user;
                    if (Token.isValid(access_token)) {
                        AppStorage.store(user, access_token)
                    }
                    // this.$router.push({name: 'forum'});
                    window.location.href = '/forum';
                }).catch(err => {
                    console.error(err)
                });
            }
        }
    }
</script>
