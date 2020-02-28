<template>
    <v-card>
        <v-container fluid>
            <v-card-title>
                <div>
                    <div class="headline">
                        {{ question.title}}
                    </div>
                <small class="grey--text">{{ question.user }} said on {{ question.created_at}}</small>
                </div>
            <v-spacer></v-spacer>
            <v-btn color="teal">5 replies</v-btn>
            </v-card-title>
            <v-card-text v-html="question.body" />
        </v-container>
    </v-card>
</template>

<script>
    export default {
        name: "ShowQuestion",
        props: ['question']
    }
</script>

<style scoped>

</style>
