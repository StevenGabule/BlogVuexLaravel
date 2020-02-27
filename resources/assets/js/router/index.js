import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from "../pages/Login";
import SignUp from "../pages/SignUp";
import Forum from "../pages/Forum";
import Logout from "../pages/Logout";

Vue.use(VueRouter);

const routes = [
    {path: '/login', component: Login, name: 'login'},
    {path: '/sign-up', component: SignUp, name:'sign-up'},
    {path: '/forum', component: Forum, name: 'forum'},
    {path: '/logout', component: Logout, name: 'logout'},
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
