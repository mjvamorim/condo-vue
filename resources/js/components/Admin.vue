<template>
    <div id="app">
        <v-app id="inspire" dark>
            <v-navigation-drawer clipped fixed v-model="drawer" app dark>
                <sidebar></sidebar>
            </v-navigation-drawer>

            <navbar :user="user" @comute-drawer="comuteDrawer"></navbar>

            <v-content>
                <v-container fluid fill-height>
                    <v-layout justify-center>
                        <v-flex shrink>
                            <router-view></router-view>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-content>
            <v-footer app fixed>
                <span>&copy; 2019</span>
            </v-footer>
        </v-app>
    </div>
</template>

<script>
import Sidebar from "./_sidebar";
import Navbar from "./_navbar";

export default {
    components: { Sidebar, Navbar },
    data: () => ({
        drawer: null
    }),
    methods: {
        comuteDrawer() {
            this.drawer = !this.drawer
        }
    },
    props: ["user"]
};
</script>
