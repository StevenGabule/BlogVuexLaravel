<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                    <v-icon :color="color">mdi-bell</v-icon>
                    {{ unreadcount }}
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="ur in unread" :key="ur.id">
                    <router-link :to="ur.path">
                        <v-list-item-title @click="readPath(ur)">{{
                            ur.question
                            }}
                        </v-list-item-title>
                    </router-link>
                </v-list-item>

                <v-divider></v-divider>

                <v-list-item v-for="(r, index) in read" :key="index">
                    <v-list-item-title>{{ r.question }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
    import axios from "axios";
    import Exception from "../Helpers/Exception";

    export default {
        data() {
            return {
                read: {},
                unread: {},
                unreadcount: 0
            };
        },

        created() {
            if (User.loggedIn()) {
                this.getNotifications();
            }

            Echo.private('App.User.' + User.id()).notification((notification) => {
                this.unread.unshift(notification);
                this.unreadcount++;
            })
        },

        computed: {
            color() {
                return this.unreadcount > 0 ? 'red' : 'red lighten-4';
            }
        },

        methods: {

            getNotifications() {
                axios.post("/api/notifications").then(res => {
                    this.read = res.data.read;
                    this.unread = res.data.unread;
                    this.unreadcount = res.data.unread.length;
                }).catch(error => {
                    Exception.handle(error)
                })

            },

            readPath(question) {
                axios.post("/api/markAsRead", {id: question.id}).then(res => {
                    this.unread.splice(question, 1);
                    this.read.push(question);
                    this.unreadcount--;
                });
            }
        }
    };
</script>
