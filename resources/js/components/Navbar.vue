<template>
    <nav>
        <v-app-bar color="blue" dark app>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title class="text-uppercase">
                <span>SILI.CON</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn text to="/logout">
                <span>Sair</span>
                <v-icon right>mdi-logout</v-icon>
            </v-btn>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer" dark app class="blue darken-4">

            <v-layout column align-center>
                <v-flex class="mt-5">
                    <v-avatar size="100">
                        <img src="https://www.shareicon.net/data/512x512/2017/01/06/868320_people_512x512.png" alt="">
                    </v-avatar>
                </v-flex>
                <span class="mt-4 white--text" v-if="user.user.name">{{ user.user.name }}</span>

            </v-layout>

            <v-list flat>

                <v-list-item v-for="link in links" :key="link.title" router :to="link.route" active-class="border">
                    <v-list-item-action>
                        <v-icon small>{{ link.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{ link.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

            </v-list>

        </v-navigation-drawer>

    </nav>
</template>

<script>
export default {
    data() {
        return {
            user: [],
            drawer: null,
            links: [
                { icon: 'fas fa-home', title: 'Dashboard', route: '/' },
                { icon: 'fas fa-calendar-alt', title: 'Eventos', route: '/eventos' },
                { icon: 'fas fa-user', title: 'Participantes', route: '/participantes' },
                { icon: 'fas fa-sign-out-alt', title: 'Sair', route: '/logout' },
            ]
        }
    },
    created() {
        this.getUser()
    },
    methods: {
        getUser() {
            const user = localStorage.getItem('user')
            this.user = JSON.parse(user)
        }
    }
}
</script>

<style scoped>

</style>
