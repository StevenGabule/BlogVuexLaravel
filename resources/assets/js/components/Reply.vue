<template>
    <div class="mt-5">
        <replies
            v-for="(reply, i) in content"
            :reply="reply"
            :index="i"
            :key="i"
        ></replies>
    </div>
</template>

<script>
import Replies from "./Replies";
export default {
    name: "Reply",
    props: ["question"],

    data() {
        return {
            content: this.question.replies
        };
    },

    components: {
        Replies
    },

    created() {
        this.listen();
    },

    methods: {
        listen() {

            EventBus.$on("NewReply", reply => {
                this.content.unshift(reply);
            });

            EventBus.$on("deleteReply", index => {
                axios
                    .delete(
                        `/api/question/${this.question.slug}/reply/${this.content[index].id}`
                    )
                    .then(res => {
                        this.content.splice(index, 1);
                    });
            });

            Echo.private('App.User.' + User.id()).notification((notification) => {
                this.content.unshift(notification.reply)
            });

            Echo.channel('DeleteReplyChannel').listen('DeleteReplyEvent', (e) => {
                for (let index = 0; index < this.content.length; index++) {
                    if (this.content[index].id === e.id) {
                        this.content.splice(index, 1);
                    }
                }
            });
        }
    }
};
</script>
