<template>
    <v-card>
        <v-toolbar color="cyan" dark dense>
            <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>

        <v-list-item v-for="(category, index) in categories" :key="index">
            <v-list-item-content>
                <v-list-item-title>{{ category.name }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            categories: {}
        };
    },
    created() {
        axios
            .get("/api/category")
            .then(res => (this.categories = res.data.data));
    }
};
</script>
