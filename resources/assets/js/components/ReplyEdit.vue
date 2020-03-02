<template>
    <div class="mt-4">
        <vue-simplemde
            v-model="reply.reply"
            ref="markdownEditor"
        ></vue-simplemde>
        <v-btn @click="submit" color="primary" large>Update</v-btn>
        <v-btn large @click="cancel">Cancel</v-btn>
    </div>
</template>

<script>
import VueSimplemde from "vue-simplemde";
export default {
    components: {
        VueSimplemde
    },

    props: ["reply"],

    methods: {
        cancel() {
            EventBus.$emit("CancelEditing");
        },

        submit() {
            axios
                .patch(
                    `/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,
                    { body: this.reply.reply }
                )
                .then(res => {
                    this.body = "";
                    this.cancel();
                });
        }
    }
};
</script>
