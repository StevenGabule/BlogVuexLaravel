import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from "../pages/Login";
import SignUp from "../pages/SignUp";
import Forum from "../pages/Forum";
import Logout from "../components/Logout";
import Discussion from "../pages/Discussion";
import AskQuestion from "../pages/AskQuestion";

Vue.use(VueRouter);

const routes = [
    {path: '/login', component: Login, name: 'login'},
    {path: '/sign-up', component: SignUp, name:'sign-up'},
    {path: '/logout', component: Logout, name: 'logout'},
    {path: '/forum', component: Forum, name: 'forum'},
    {path: '/question/:slug', component: Discussion, name: 'discussion'},
    {path: '/ask-question', component: AskQuestion, name: 'ask-question'},
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
