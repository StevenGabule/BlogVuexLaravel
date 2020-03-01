<template>
    <v-container>
        <h2>Write a question here!</h2>
        <v-form @submit.prevent="handleQuestion">
            <v-text-field label="Title" v-model="form.title" type="text" required/>
            <v-select :items="categories"
                      item-text="name"
                      item-value="id"
                      v-model="form.category_id"
                      label="Choose the category of the question" autocomplete></v-select>
            <vue-simplemde v-model="form.body" ref="markdownEditor"></vue-simplemde>
            <v-btn type="submit" color="primary" large>Submit Question</v-btn>
        </v-form>
    </v-container>
</template>

<script>
    import axios from "axios";
    import VueSimplemde from 'vue-simplemde';

    export default {
        name: "AskQuestion",
        components: {
            VueSimplemde
        },

        data() {
            return {
                form: {
                    title: '',
                    body: '',
                    category_id: ''
                },
                categories: [],
                error: {}
            }
        },

        created() {
            axios.get('/api/category').then(res => {
                this.categories = res.data.data;
            });
        },

        methods: {
            handleQuestion() {
                axios.post('/api/question', this.form)
                    .then(res => console.log(res.data.data))
                    .catch(err => console.error(err.response.data.errors));
            }
        }
    }
</script>

<style>
    @import '~simplemde/dist/simplemde.min.css';
</style>
