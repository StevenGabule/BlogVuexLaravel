<template>
    <v-card style="padding: 30px;">
        <h2>Edit A Question</h2>
        <v-form @submit.prevent="handleQuestion">
            <v-text-field
                label="Title"
                v-model="form.title"
                type="text"
                required
            />
            <v-select
                :items="categories"
                item-text="name"
                item-value="id"
                v-model="form.category_id"
                label="Choose the category of the question"
                autocomplete
            ></v-select>

            <vue-simplemde
                v-model="form.body"
                ref="markdownEditor"
            ></vue-simplemde>

            <v-card-actions>
                <v-btn type="submit" color="red" large style="color: white"
                    >Update Question</v-btn
                >
                <v-btn color="black" large style="color: white" @click="cancel"
                    >Cancel</v-btn
                >
            </v-card-actions>
        </v-form>
    </v-card>
</template>

<script>
import axios from "axios";
import VueSimplemde from "vue-simplemde";

export default {
    props: ["question"],
    name: "AskQuestion",
    components: {
        VueSimplemde
    },

    data() {
        return {
            form: {
                title: null,
                body: null
            },
            categories: [],
            error: {}
        };
    },

    mounted() {
        this.form = this.question;
    },

    created() {
        axios.get("/api/category").then(res => {
            this.categories = res.data.data;
        });
    },

    methods: {
        handleQuestion() {
            axios
                .patch(`/api/question/${this.form.slug}`, this.form)
                .then(res => this.cancel())
                .catch(err => console.error(err.response.data.errors));
        },

        cancel() {
            EventBus.$emit("cancelEditing");
        }
    }
};
</script>

<style>
@import "~simplemde/dist/simplemde.min.css";
</style>
