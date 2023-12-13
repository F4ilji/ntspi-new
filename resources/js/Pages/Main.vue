<template>
	<Head>
		<title>Главная</title>
		<meta name="description" content="Your page description">
	</Head>
    <MainNavbar :sections="this.mainSections"></MainNavbar>


</template>

<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import axios from "axios";
import {Head, Link} from "@inertiajs/vue3";


export default {
    name: "Main",
    data() {
        return {

        }
    },

    props: [
		'mainSections',
    ],
    components: {
        MainNavbar,
		Head
    },

    methods: {
    },

}


</script>

<style scoped>

</style>
