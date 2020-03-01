<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-form @submit.prevent="create">
                    <h2>Create New Category</h2>
                    <v-text-field
                        label="Category name"
                        v-model="form.name"
                        required
                    />
                    <v-btn type="submit" color="teal" style="color: white;"
                        >Publish</v-btn
                    >
                </v-form>

                <v-card class="mx-auto mt-5" max-width="100%" tile>
                    <v-list>
                        <v-subheader>All Categories</v-subheader>
                        <v-list-item-group color="primary">
                            <v-list-item
                                v-for="(category, i) in categories"
                                :key="i"
                            >
                                <v-card-actions>
                                    <v-btn icon small @click="edit">
                                        <v-icon color="orange"
                                            >mdi-pencil</v-icon
                                        >
                                    </v-btn>

                                    <v-btn
                                        icon
                                        small
                                        @click="destroy(category.slug, i)"
                                    >
                                        <v-icon color="red">mdi-delete</v-icon>
                                    </v-btn>
                                </v-card-actions>

                                <v-list-item-content>
                                    <v-list-item-title
                                        v-text="category.name"
                                    ></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "category-new",

    data() {
        return {
            form: {
                name: null
            },
            categories: []
        };
    },

    created() {
        axios
            .get("/api/category")
            .then(res => (this.categories = res.data.data));
    },

    methods: {
        create() {
            axios.post("/api/category", this.form).then(res => {
                this.categories.unshift(res.data);
            });
        },
        edit() {},

        destroy(slug, index) {
            axios
                .delete(`/api/category/${slug}`)
                .then(res => this.categories.splice(index, 1));
        }
    }
};
</script>
