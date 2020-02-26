<template>
    <v-toolbar>
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        <v-toolbar-title>Forum</v-toolbar-title>
        <v-spacer></v-spacer>
        <div class="hidden-sm-and-down">
            <router-link to="/home" class="td-none">
                <v-btn text>Home</v-btn>
            </router-link>
            <router-link to="/ask-question" class="td-none">
                <v-btn text>Ask Question</v-btn>
            </router-link>
            <router-link to="/categories" class="td-none">
                <v-btn text>Categories</v-btn>
            </router-link>
            <router-link to="/login" class="td-none">
                <v-btn text>Login</v-btn>
            </router-link>
            <router-link to="/sign-up" class="td-none">
                <v-btn text>Sign up</v-btn>
            </router-link>
        </div>
    </v-toolbar>
</template>

<script>
    export default {
        name: "Toolbar"
    }
</script>
<style>
    .td-none {
        text-decoration: none;
    }
</style>
