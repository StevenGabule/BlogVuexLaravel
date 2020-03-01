<template>
    <v-toolbar>
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        <v-toolbar-title>Forum</v-toolbar-title>
        <v-spacer></v-spacer>
        <div class="hidden-sm-and-down">
            <router-link
                v-for="item in items"
                :key="item.title"
                :to="item.to"
                class="td-none"
            >
                <span v-if="item.show">
                    <v-btn text>{{ item.title }}</v-btn>
                </span>
            </router-link>
        </div>
    </v-toolbar>
</template>

<script>
export default {
    name: "Toolbar",
    data() {
        return {
            items: [
                {
                    title: "Forum",
                    to: "/forum",
                    show: true
                },
                {
                    title: "Ask Question",
                    to: "/ask-question",
                    show: User.loggedIn()
                },
                {
                    title: "Categories",
                    to: "/category-new",
                    show: User.loggedIn()
                },
                {
                    title: "Login",
                    to: "/login",
                    show: !User.loggedIn()
                },
                {
                    title: "Sign up",
                    to: "/sign-up",
                    show: !User.loggedIn()
                },
                {
                    title: "Logout",
                    to: "/logout",
                    show: User.loggedIn()
                }
            ]
        };
    },
    created() {
        EventBus.$on("logout", () => {
            User.logout();
            window.location.href = "/login";
        });
    }
};
</script>
<style>
.td-none {
    text-decoration: none;
}
</style>
