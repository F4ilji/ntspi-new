<template>
    <MainNavbar :sections="this.mainSections"></MainNavbar>


</template>

<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import axios from "axios";


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
        MainNavbar
    },

    methods: {
    },

}


</script>

<style scoped>

</style>
