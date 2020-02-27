<template>
    <div>
        <v-container fluid>
            <v-row>
                <v-col cols="12" align="center" justify="center" class="grey lighten-5" style="min-height:80vh">
                    <v-card style="width: 500px" class="pa-5">
                        <h1 class="pb-4">Sign up page</h1>
                        <v-alert v-for="error in errors" key="error" type="error" class="" style="text-align: left;">
                            {{ error[0]}}
                        </v-alert>
                        <v-form @submit.prevent="handleSignUp">
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        outlined
                                        label="Name"
                                        v-model="form.name"
                                        :rules="[rules.required, rules.counter]"
                                        type="text" required/>
                                </v-col>

                                <v-col cols="12">
                                    <v-text-field
                                        outlined
                                        label="Email address"
                                        v-model="form.email"
                                        type="email"
                                        :rules="[rules.required, rules.email]"
                                        required/>
                                </v-col>

                                <v-col cols="12">
                                    <v-text-field outlined label="Password" v-model="form.password"
                                                  type="password" @click:append="show4 = !show4"
                                                  :rules="[rules.password_req]"
                                                  required :append-icon="show4 ? 'mdi-eye' : 'mdi-eye-off'"
                                                  :type="show4 ? 'text' : 'password'"/>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field outlined label="Confirm Password"
                                                  v-model="form.password_confirmation"
                                                  @click:append="show3 = !show3"
                                                  type="password"
                                                  :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
                                                  :type="show3 ? 'text' : 'password'"
                                                  :rules="[rules.password, rules.password_con]"
                                                  required/>
                                    <v-btn type="submit" large color="primary">Submit</v-btn>

                                </v-col>
                            </v-row>
                        </v-form>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    import Token from "../Helpers/Token";
    import AppStorage from "../Helpers/AppStorage";
    import axios from "axios";

    export default {
        name: "SignUp",
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                errors: {},
                show4: false,
                show3: false,
                rules: {
                    required: value => !!value || 'Required.',
                    counter: value => value.length <= 20 || 'Max 20 characters',
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    },
                    password_req: value => !!value || 'Required password',
                    password_con: value => !!value || 'Required confirm password',
                    password: value => value === this.form.password || 'Password mismatched'
                },
            }
        },

        created() {
            if (User.loggedIn())  {
                this.$router.push({name: 'forum'});
            }
        },

        methods: {
            handleSignUp() {
                axios.post('/api/auth/signup', this.form)
                    .then(res => {
                        const access_token = res.data.access_token;
                        const user = res.data.user;
                        if (Token.isValid(access_token)) {
                            AppStorage.store(user, access_token)
                        }
                        this.$router.push({name: 'forum'});
                    }).catch(err => {
                    this.errors = err.response.data.errors
                })

            }
        }
    }
</script>
