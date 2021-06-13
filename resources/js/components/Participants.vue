<template>
    <v-layout row class="ma-4">
        <h1 class="subheading grey--text">Participantes</h1>
        <v-flex md12 class="ma-4">

            <template>
                <v-data-table
                    :headers="headers"
                    :items="students"
                    :items-per-page="10"
                >

                    <template v-slot:item.events="{ item }">
                        <v-rating v-model="item.events.length" background-color="purple lighten-3" color="purple" small dense readonly length="3"></v-rating>
                    </template>

                </v-data-table>
            </template>

        </v-flex>
    </v-layout>
</template>

<script>

import axios from 'axios'

export default {
    data: () => ({
        user: [],
        headers: [
            {
                text: 'Nome',
                align: 'start',
                sortable: false,
                value: 'name',
            },
            { text: 'Email', value: 'email' },
            { text: 'Cidade', value: 'city' },
            { text: 'Ranking', value: 'events' },
        ],
        students: [],

    }),
    created() {
        this.getUser()
        this.initialize()
    },
    methods: {
        initialize() {
            axios.get(`/api/participantes`, {
                headers: {
                    'Authorization': 'Bearer '+this.user.access_token
                }
            })
            .then(response => {
                this.students = response.data
            })
            .catch(error => console.log(error.response))
        },
        getUser() {
            const user = localStorage.getItem('user')
            this.user = JSON.parse(user)
        }
    }
}
</script>

<style scoped>

</style>
