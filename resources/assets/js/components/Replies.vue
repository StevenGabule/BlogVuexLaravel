<template>
    <div>
        <v-card class="mb-5">
            <v-card-title>
                <div class="headline mr-2">{{ reply.user }}</div>
                <div>said on {{ reply.created_at }}</div>
                <v-spacer></v-spacer>
                <like></like>
            </v-card-title>

            <v-divider></v-divider>

            <reply-edit v-if="editing" :reply="reply"></reply-edit>

            <v-card-text v-else v-html="rep" />

            <v-divider></v-divider>

            <div v-if="!editing">
                <v-card-actions v-if="own">
                    <v-btn icon small @click="edit">
                        <v-icon color="orange">mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn icon small @click="destroy">
                        <v-icon color="red">mdi-delete</v-icon>
                    </v-btn>
                </v-card-actions>
            </div>
        </v-card>
    </div>
</template>

<script>
import md from "marked";
import ReplyEdit from "./ReplyEdit";
import Like from "./like";

export default {
    name: "Replies",
    props: ["reply", "index"],
    components: { ReplyEdit, Like },

    data() {
        return {
            editing: false
        };
    },

    computed: {
        own() {
            return User.own(this.reply.user_id);
        },
        rep() {
            return md.parse(this.reply.reply);
        }
    },

    created() {
        this.listen();
    },

    methods: {
        listen() {
            EventBus.$on("CancelEditing", () => {
                this.editing = false;
            });
        },
        destroy() {
            EventBus.$emit("deleteReply", this.index);
        },

        edit() {
            this.editing = true;
        }
    }
};
</script>
