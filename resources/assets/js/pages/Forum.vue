<template>
    <v-container fluid grid-list-md>
        <v-layout>
            <v-flex xs8>
                <question v-for="question in questions" :key="question.path" :question="question"></question>
            </v-flex>
            sidebar
        </v-layout>
    </v-container>
</template>

<script>
    import question from '../components/Question';
    import axios from 'axios';

    export default {
        name: "Forum",

        data() {
            return {
                questions: []
            }
        },

        components: {
            question
        },
        created() {
            axios.get('/api/question')
                .then(res => this.questions = res.data.data)
                .catch(error => console.error(error.response.data.errors))
        }
    }
</script>

<style scoped>

</style>
