<template>
    <div>
        <v-toolbar color="cyan" dark dense>
            <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>

        <v-list-item v-for="(category, index) in categories" :key="index">
            <v-list-item-content>
                <v-list-item-icon>
                    <v-icon v-text="item.icon"></v-icon>
                </v-list-item-icon>
                <v-list-item-title> {{ category.name }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-card class="mx-auto mt-5" max-width="100%" tile>
            <v-list>
                <v-subheader>All Categories</v-subheader>
                <v-list-item-group color="primary">
                    <v-list-item v-for="(category, i) in categories" :key="i">
                        <v-card-actions>
                            <v-btn icon small @click="edit">
                                <v-icon color="orange">mdi-pencil</v-icon>
                            </v-btn>

                            <v-btn icon small>
                                <v-icon color="red">mdi-delete</v-icon>
                            </v-btn>
                        </v-card-actions>

                        <v-list-item-content>
                            <v-list-item-title
                                v-text="category.name"
                            ></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-card>
        <v-simple-table fixed-header height="420px">
            <template v-slot:default>
                <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(category, index) in categories" :key="index">
                        <td>{{ category.name }}</td>
                        <td>
                            <v-card-actions>
                                <v-btn icon small @click="edit">
                                    <v-icon color="orange">mdi-pencil</v-icon>
                                </v-btn>

                                <v-btn
                                    icon
                                    small
                                    @click="destroy(category.slug, index)"
                                >
                                    <v-icon color="red">mdi-delete</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </td>
                    </tr>
                </tbody>
            </template>
        </v-simple-table>
    </div>
</template>
