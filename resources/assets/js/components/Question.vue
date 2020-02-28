<template>
    <v-card class="mb-4">
        <v-card-title primary-title>
            <div>
                <h3 class="headline mb-0">
                    <router-link :to="question.path" class="tdn primary-here">{{ question.title }}</router-link>
                </h3>
                <small class="grey--text">{{ question.user}} said on {{ question.created_at }}</small>
            </div>
        </v-card-title>
        <v-card-text>
            {{ question.body}}
        </v-card-text>
    </v-card>
</template>

<script>
    export default {
        name: "Question",
        props: ['question']
    }
</script>

<style>
    .tdn {
        text-decoration: none;}
    .primary-here {
        color: red !important;
    }
</style>
