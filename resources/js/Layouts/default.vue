<template>
    <v-app  class="pa-6">
        <Header />
        <Sidebar />

        <v-main class="content mt-15">

            <slot />
            <Footer />
        </v-main>
    </v-app>
</template>

<script>
import Header from '../Components/Header/HeaderComponent.vue';
import Sidebar from '../Components/Sidebar/SidebarComponent.vue';
import Footer from "../Components/FooterComponent.vue";

export default {
    name: 'Layout',
    components: {Footer, Header, Sidebar },
};
</script>

<style src="./Layout.scss" lang="scss"></style>
