<template>
    <show-question :question="question"></show-question>
</template>

<script>
    import axios from "axios";
    import ShowQuestion from "../components/ShowQuestion";

    export default {
        name: "Discussion",
        components: {
           ShowQuestion
        },
        data() {
           return {
               question: {}
           }
        },

        created() {
            axios.get(`/api/question/${this.$route.params.slug}`).then(res => this.question = res.data.data)
        },
    }
</script>

<style scoped>

</style>
