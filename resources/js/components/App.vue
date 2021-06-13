<template>
    <v-app>
        <navbar v-if="user"></navbar>
        <v-content v-if="user">
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </v-content>
        <login v-else></login>

    </v-app>
</template>

<script>

import Navbar from "./Navbar";
import Login from "./Login";

export default {
    components: {
        Navbar,
        Login
    },
    data() {
        return {
            user: []
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
