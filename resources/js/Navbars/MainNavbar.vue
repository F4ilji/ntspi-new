<template>
	<header class="flex fixed top-0 left-0 right-0 flex-wrap md:justify-start md:flex-nowrap z-50 w-full bg-white text-sm py-3 md:py-0 dark:bg-gray-800">
        <nav class="max-w-screen-xl w-full mx-auto px-4" aria-label="Global">
            <div class="relative md:flex md:items-center md:justify-between">
                <div class="flex items-center justify-between">
                    <a class="flex-none text-xl font-semibold dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/" aria-label="Brand">
                        <img class="max-w-[300px]" src="/logos/ntspi-logo.svg" alt="">
                    </a>
                    <div class="md:hidden">
                        <button type="button" class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                            <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                            <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </div>
                </div>

                <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
                    <div class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
                        <div class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">

                            <template v-for="section in this.sections.data" :key="section.id">
                                <div class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] md:[--trigger:hover] py-3 md:py-6">
                                    <button type="button" class="active:text-blue-600 flex items-center w-full text-gray-800 hover:text-gray-600 font-medium dark:text-gray-200 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                        {{ section.title }}
                                        <svg class="flex-shrink-0 ms-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                    <div class="hs-dropdown-menu transition-opacity duration-150 md:duration-500 hs-dropdown-open:opacity-100 opacity-0 w-full hidden z-10 top-full start-0 min-w-[15rem] bg-white md:shadow-2xl rounded-lg py-2 md:p-4 dark:bg-gray-800 dark:divide-gray-700 before:absolute before:-top-5 before:start-0 before:w-full before:h-5">
                                        <div class="grid grid-cols-2 md:grid-cols-10">

                                            <template v-for="subsection in section.subSections" :key="subsection.id">
                                                <div class="md:col-span-3">
                                                    <div class="flex flex-col py-6 px-3 md:px-6">
                                                        <div class="space-y-4">
                                                            <div class="flex items-center mb-2 gap-x-2">
                                                                <span class="text-xs font-bold uppercase text-gray-800 dark:text-gray-200">{{ subsection.title }}</span>
                                                            </div>

                                                            <template v-for="page in subsection.pages" :key="page.id">
                                                                <a :class="{'text-[#135aae] hover:text-gray-800 font-semibold ' : isSameRoute(page.path), 'text-gray-800 hover:text-[#2C6288]' : !isSameRoute(page.path) }" class="flex items-center gap-x-2" :href="route('page.view', page.path) + '/'">
                                                                    <div class="grow">
                                                                        <p>{{ page.title }}</p>
                                                                    </div>
                                                                </a>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                </div>
                            </template>

                            <div class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] md:[--trigger:hover] py-3 md:py-6">
                                <button type="button" class="active:text-blue-600 flex items-center w-full text-gray-800 hover:text-gray-600 font-medium dark:text-gray-200 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                    Дополнительное образование
                                </button>

                            </div>

                            <Link :href="route('client.schedule')" class="hover:opacity-70">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>
                            </Link>

                            <button class="hover:opacity-70">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>





</template>

<script>

import { Link } from "@inertiajs/vue3";
import axios from "axios";


export default {
    name: 'MainNavBar',
	props: {
		sections: {
			type: Array,
		}

	},
    data() {
        return {
        }
    },
    components: {
        Link,
    },
    methods: {
        isSameRoute(route) {
            if (this.$page.props.ziggy.location === this.$page.props.ziggy.url + '/' + route) {
                return true
            }
        },

    },


}

</script>

<style scoped>

header {
  transition: all 0.3s ;
  backdrop-filter: saturate(180%) blur(7px);
  background: hsla(0,0%,100%,.6);
}

</style>
