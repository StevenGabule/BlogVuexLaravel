<template>
    <div>
        <v-btn icon @click="like">
            <v-icon :color="color">mdi-heart</v-icon> {{ count }}
        </v-btn>
    </div>
</template>

<script>

    export default {
    props: ["content"],

    data() {
        return {
            liked: this.content.liked,
            count: this.content.like_count
        };
    },

    created() {
        Echo.channel('LikeChannel').listen('LikeEvent', (e) => {
            if (this.content.id === e.id) {
                e.type === 1 ? this.count++ : this.count--;
            }
        })
    },

    computed: {
        color() {
            return this.liked ? "red" : "red lighten-4";
        }
    },

    methods: {
        like() {
            if (User.loggedIn()) {
                this.liked ? this.decs() : this.incs();
                this.liked = !this.liked;
            }
        },
        incs() {
            axios.post(`/api/like/${this.content.id}`).then(res => {
                this.count++;
            });
        },
        decs() {
            axios.delete(`/api/like/${this.content.id}`).then(res => {
                this.count--;
            });
        }
    }
};
</script>
