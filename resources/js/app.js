/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import Vuetify from "vuetify";
import VueRouter from "vue-router";
import "@mdi/font/css/materialdesignicons.css";
Vue.use(Vuetify);
Vue.use(VueRouter);

import "vuetify/dist/vuetify.min.css";

import Auth from "./auth";

Vue.prototype.$auth = new Auth(window.user);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component("admin", require("./components/Admin.vue").default);

import Dashboard from "./pages/Dashboard";
import Settings from "./pages/Settings";
import Users from "./pages/Users";
import Roles from "./pages/Roles";
import Permissions from "./pages/Permissions";
import Activities from "./pages/Activities";
import Proprietarios from "./pages/Proprietarios";
import Felipe from "./pages/Felipe";

const routes = [
    {
        path: "/admin/",
        component: Dashboard
    },
    {
        path: "/admin/users",
        component: Users
    },
    {
        path: "/admin/roles",
        component: Roles
    },
    {
        path: "/admin/permissions",
        component: Permissions
    },
    {
        path: "/admin/settings",
        component: Settings
    },
    {
        path: "/admin/activities",
        component: Activities
    },
    {
        path: "/admin/felipe",
        component: Felipe
    },
    {
        path: "/admin/proprietarios",
        component: Proprietarios
    },
    {
        path: "/admin/unidades",
        component: Unidades
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const opts = {};
const app = new Vue({
    el: "#app",
    router,
    vuetify: new Vuetify(opts)
});
