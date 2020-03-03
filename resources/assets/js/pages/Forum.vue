<template>
    <v-container fluid grid-list-md>
        <v-layout>
            <v-flex xs8>
                <question
                    v-for="question in questions"
                    :key="question.id"
                    :question="question"
                ></question>
            </v-flex>
            <v-flex xs4>
                <sidebar />
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import question from "../components/Question";
import Sidebar from "../components/Sidebar";
import axios from "axios";

export default {
    name: "Forum",

    data() {
        return {
            questions: []
        };
    },

    components: {
        question,
        Sidebar
    },
    created() {
        axios
            .get("/api/question")
            .then(res => (this.questions = res.data.data))
            .catch(error => console.error(error.response.data.errors));
    }
};
</script>

<style scoped></style>
