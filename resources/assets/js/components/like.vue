<template>
    <div>
        <v-btn icon @click="like">
            <v-icon color="red">mdi-heart</v-icon> {{ count }}
        </v-btn>
    </div>
</template>

<script>
export default {
    data() {
        return {
            liked: false,
            count: 0
        };
    },
    methods: {
        like() {
            if (User.loggedIn()) {
                this.liked ? this.decs() : this.incs();
                this.liked = !this.liked;
            }
        },
        incs() {
            this.count++;
        },
        decs() {
            this.count--;
        }
    }
};
</script>
