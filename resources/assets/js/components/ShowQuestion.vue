<template>
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

                <v-btn color="teal">5 replies</v-btn>
            </v-card-title>
            <v-card-text v-html="body" />

            <v-card-actions v-if="own">
                <v-btn icon small>
                    <v-icon color="orange">mdi-pencil</v-icon>
                </v-btn>
                <v-btn icon small @click="destroy">
                    <v-icon color="red">mdi-delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-container>
    </v-card>
</template>

<script>
import md from "marked";

export default {
    name: "ShowQuestion",
    props: ["question"],

    data() {
        return {
            own: User.own(this.question.user_id)
        };
    },

    computed: {
        body() {
            return md.parse(this.question.body);
        }
    },
    methods: {
        destroy() {
            axios
                .delete(`/api/question/${this.question.slug}`)
                .then(res => this.$router.push("/forum"))
                .catch(err => console.error(res.response.data.errors));
        }
    }
};
</script>
