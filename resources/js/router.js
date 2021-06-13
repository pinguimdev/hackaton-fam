import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './components/Home'
import Events from './components/Events'
import Participants from './components/Participants'
import Logout from './components/Logout'
import Login from './components/Login'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Home, name: 'home' },
        { path: '/login', component: Login, name: 'login' },
        { path: '/eventos', component: Events, name: 'eventos' },
        { path: '/participantes', component: Participants, name: 'participantes' },
        { path: '/logout', component: Logout, name: 'logout' },
    ]
})

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user');
    if (!loggedIn) {
        next('/login');
    } else {
        next();
    }
});

export default router
