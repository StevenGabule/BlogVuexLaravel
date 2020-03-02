<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-form @submit.prevent="submit">
                    <h2>Create New Category</h2>
                    <v-text-field
                        label="Category name"
                        v-model="form.name"
                        required
                    />
                    <v-btn type="submit" color="teal" style="color: white;">{{
                        editing ? "Update" : "Publish"
                    }}</v-btn>
                </v-form>

                <v-simple-table fixed-header height="420px">
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(category, index) in categories"
                                :key="index"
                            >
                                <td>{{ category.name }}</td>
                                <td>
                                    <v-card-actions>
                                        <v-btn icon small @click="edit(index)">
                                            <v-icon color="orange"
                                                >mdi-pencil</v-icon
                                            >
                                        </v-btn>

                                        <v-btn
                                            icon
                                            small
                                            @click="
                                                destroy(category.slug, index)
                                            "
                                        >
                                            <v-icon color="red"
                                                >mdi-delete</v-icon
                                            >
                                        </v-btn>
                                    </v-card-actions>
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
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
            categories: [],
            editSlug: null,
            editing: false
        };
    },

    created() {
        if (!User.admin()) {
            this.$router.push("/forum");
        }
        axios
            .get("/api/category")
            .then(res => (this.categories = res.data.data));
    },

    methods: {
        submit() {
            this.editSlug ? this.update() : this.create();
        },

        update() {
            axios
                .patch(`/api/category/${this.editSlug}`, this.form)
                .then(res => {
                    this.categories.unshift(res.data);
                    this.form.name = "";
                    this.editing = false;
                });
        },

        create() {
            axios.post("/api/category", this.form).then(res => {
                this.categories.unshift(res.data);
                this.form.name = "";
            });
        },

        edit(index) {
            this.form.name = this.categories[index].name;
            this.editSlug = this.categories[index].slug;
            this.editing = true;
            this.categories.splice(index, 1);
        },

        destroy(slug, index) {
            axios
                .delete(`/api/category/${slug}`)
                .then(res => this.categories.splice(index, 1));
        }
    }
};
</script>
