import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

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
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
