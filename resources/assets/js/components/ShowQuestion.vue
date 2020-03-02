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
                            {{ question.created_at }}</small
                        >
                    </div>

                    <v-spacer></v-spacer>

                    <v-btn color="teal" style="color: white;"
                        >{{ question.replies_count }} replies</v-btn
                    >
                </v-card-title>

                <v-card-text v-html="body" />

                <v-card-actions v-if="own">
                    <v-btn icon small @click="edit">
                        <v-icon color="orange">mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn icon small @click="destroy">
                        <v-icon color="red">mdi-delete</v-icon>
                    </v-btn>
                </v-card-actions>

                <v-btn class="ml-3" color="primary" @click="enableReply"
                    >Reply</v-btn
                >
                <v-btn class="ml-3" color="info">View Reply</v-btn>
            </v-container>
        </v-card>
        <new-reply v-if="replying" :slug="question.slug" />
        <reply :question="question" />
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
            replying: false
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
