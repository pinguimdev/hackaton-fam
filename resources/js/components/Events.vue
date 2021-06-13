<template>
    <v-layout row class="ma-4">
        <h1 class="subheading grey--text">Eventos</h1>
        <v-flex md12 class="ma-4">

            <template>
                <v-data-table
                    :headers="headers"
                    :items="events"
                    :items-per-page="10"
                ></v-data-table>
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
                text: 'Evento',
                align: 'start',
                sortable: false,
                value: 'name',
            },
            { text: 'Ano', value: 'season' },
        ],
        events: [],
    }),
    created() {
        this.getUser()
        this.getEvents()
    },
    methods: {
        getEvents() {
            axios.get(`/api/eventos`, {
                headers: {
                    'Authorization': 'Bearer '+this.user.access_token
                }
            })
            .then(response => {
                this.events = response.data
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
