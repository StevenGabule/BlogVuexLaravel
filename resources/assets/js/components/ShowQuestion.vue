<template>
    <div>
        <v-card>
            <v-container fluid>
                <v-card-title>
                    <div>
                        <div class="headline">
                            {{ question.title }}
                        </div>
                        <small class="grey--text"
                        >{{ question.user }} said on
                            {{ question.created_at }}
                        </small
                        >
                    </div>

                    <v-spacer></v-spacer>

                    <v-btn color="teal" style="color: white;"
                    >{{ replyCount }} replies
                    </v-btn
                    >
                </v-card-title>

                <v-card-text v-html="body"/>

                <v-card-actions v-if="own">
                    <v-btn icon small @click="edit">
                        <v-icon color="orange">mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn icon small @click="destroy">
                        <v-icon color="red">mdi-delete</v-icon>
                    </v-btn>
                </v-card-actions>

                <v-btn class="ml-3" color="primary" @click="enableReply" v-if="loggedIn"
                >Reply
                </v-btn
                >
            </v-container>
        </v-card>

        <new-reply v-if="replying" :slug="question.slug"/>

        <div v-if="!loggedIn" class="text-center mt-5">
            <router-link to="/login" style="text-decoration:none;color:white;">
                <v-btn color="error" large>Please login to reply this thread.</v-btn>
            </router-link>
        </div>

        <reply :question="question"/>
    </div>
</template>

<script>
    import md from "marked";
    import Reply from "./Reply";
    import NewReply from "./ReplyNew";

    export default {
        name: "ShowQuestion",

        components: {
            Reply,
            NewReply
        },

        props: ["question"],

        data() {
            return {
                own: User.own(this.question.user_id),
                loggedIn: User.loggedIn(),
                replying: false,
                replyCount: this.question.replies_count,
            };
        },

        created() {
            this.listen();
        },

        computed: {
            body() {
                return md.parse(this.question.body);
            }
        },

        methods: {
            listen() {
                EventBus.$on("starReplying", () => {
                    this.replying = true;
                });

                EventBus.$on("CancelReplying", () => {
                    this.replying = false;
                });

                EventBus.$on("NewReply", () => {
                    this.replyCount++;
                });

                EventBus.$on("deleteReply", () => {
                    this.replyCount--;
                });

                Echo.private('App.User.' + User.id()).notification((notification) => {
                    this.replyCount++;
                });

                Echo.channel('DeleteReplyChannel').listen('DeleteReplyEvent', (e) => {
                    this.replyCount--;
                });
            },

            destroy() {
                axios
                    .delete(`/api/question/${this.question.slug}`)
                    .then(res => this.$router.push("/forum"))
                    .catch(err => console.error(res.response.data.errors));
            },

            edit() {
                EventBus.$emit("startEditing");
            },

            enableReply() {
                this.replying = true;
            }
        }
    };
</script>
