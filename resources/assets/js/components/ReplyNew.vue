<template>
    <div class="mt-4">
        <vue-simplemde v-model="body" ref="markdownEditor"></vue-simplemde>
        <v-btn @click="submit" color="primary" large>Submit Reply</v-btn>
        <v-btn large @click="cancel">Cancel</v-btn>
    </div>
</template>

<script>
import VueSimplemde from "vue-simplemde";
export default {
    components: {
        VueSimplemde
    },
    props: ["slug"],
    data() {
        return {
            body: null
        };
    },
    methods: {
        cancel() {
            EventBus.$emit("CancelReplying");
        },
        submit() {
            axios
                .post(`/api/question/${this.slug}/reply`, { body: this.body })
                .then(res => {
                    this.body = "";
                    EventBus.$emit("NewReply", res.data.reply);
                    this.cancel();
                });
        }
    }
};
</script>
