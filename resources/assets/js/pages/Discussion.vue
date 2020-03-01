<template>
    <v-container class="grey lighten-5" v-if="question">
        <v-row>
            <v-col cols="12" class="p-4">
                <edit-question
                    v-if="editing"
                    :question="question"
                ></edit-question>
                <show-question v-else :question="question"></show-question>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from "axios";
import ShowQuestion from "../components/ShowQuestion";
import EditQuestion from "../components/EditQuestion";

export default {
    name: "Discussion",
    components: {
        ShowQuestion,
        EditQuestion
    },
    data() {
        return {
            question: null,
            editing: false
        };
    },

    created() {
        this.listen();
        this.getQuestion();
    },

    methods: {
        listen() {
            EventBus.$on("startEditing", () => {
                this.editing = true;
            });
            EventBus.$on("cancelEditing", () => {
                this.editing = false;
            });
        },
        getQuestion() {
            axios
                .get(`/api/question/${this.$route.params.slug}`)
                .then(res => (this.question = res.data.data));
        }
    }
};
</script>

<style scoped></style>
