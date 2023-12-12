<template>
    <AdminLayout>

        <!-- Blog Article -->
        <div class="max-w-3xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
            <div class="max-w-2xl">


                <h1></h1>
                <!-- Avatar Media -->
                <!-- End Avatar Media -->
                <Link :href="route('admin.user.index')" class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-blue-400 mb-6">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Вернуться к новостям
                </Link>
                <!-- Content -->
                <div class="space-y-5 md:space-y-8">
                    <div class="space-y-3">
                        <h2 class="text-2xl font-bold md:text-3xl dark:text-white">{{ user.data.title }}</h2>
                    </div>
                    <div class="flex justify-between border-t border-b border-gray-300 py-4 items-center mb-6">
                        <div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">

                            <div class="grow">
                                <div class="grid sm:flex sm:justify-between sm:items-center gap-2">
                                    <ol class="flex items-center whitespace-nowrap min-w-0" aria-label="Breadcrumb">
                                        <li class="text-sm">
                                            <a class="flex items-center text-gray-500 hover:text-blue-600" href="#">
                                                Главная
                                                <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="text-sm">
                                            <a class="flex items-center text-gray-500 hover:text-blue-600" href="#">
                                                Новости
                                                <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
                                            {{ textLimit(user.data.title, 15) }}
                                        </li>
                                    </ol>
                                    <div class="flex items-center">
                                        <ul class="block text-xs text-gray-500  mr-3">
                                            <li class="inline-block relative pr-6 last:pr-0 last-of-type:before:hidden before:absolute before:top-1/2 before:right-2 before:-translate-y-1/2 before:w-1 before:h-1 before:bg-gray-300 before:rounded-full dark:text-gray-400 dark:before:bg-gray-600">
                                                Опубликовано: {{ user.data.created_post }}
                                            </li>
                                        </ul>
                                        <div class="hs-tooltip [--trigger:hover] [--placement:bottom]">
                                            <div class="hs-tooltip-toggle sm:mb-1 block text-left cursor-pointer">
                                            <span class="font-normal text-sm text-gray-800 dark:text-gray-200 underline hover:text-gray-500">
                                                {{ user.data.authors[0].name }}
                                            </span>
                                                <!-- Dropdown Card -->
                                                <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 max-w-xs cursor-default bg-gray-900 divide-y divide-gray-700 shadow-lg rounded-xl dark:bg-black" role="tooltip">
                                                    <!-- Body -->
                                                    <div class="p-4 sm:p-5">
                                                        <div class="mb-2 flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                                                            <div class="flex-shrink-0">
                                                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Image Description">
                                                            </div>

                                                            <div class="grow">
                                                                <p class="text-lg font-semibold text-gray-200">
                                                                    {{ user.data.authors[0].name }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <p class="text-sm text-gray-400">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                        </p>
                                                    </div>
                                                    <!-- End Body -->

                                                    <!-- Footer -->
                                                    <!-- End Footer -->
                                                </div>
                                                <!-- End Dropdown Card -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <template v-for="block in JSON.parse(user.data.text).blocks">
                        <div v-if="block.type === 'paragraph'">
                            <p class="text-lg text-gray-800 dark:text-gray-200 text-justify">{{ block.data.text }}</p>
                        </div>
                        <div v-if="block.type === 'image'">
                            <figure>
                                <img :src="block.data.file.url" class="w-full object-cover rounded-xl" alt="Image Description">
                                <figcaption class="mt-3 text-sm text-center text-gray-500">
                                    {{ block.data.caption }}
                                </figcaption>
                            </figure>
                        </div>
                        <div class="flex justify-center" v-if="block.type === 'attaches'">
                            <button @click.prevent="downloadFile(block.data.file.url)" type="button" class="w-2/5 py-2 px-4 inline-flex justify-center items-center gap-2 rounded-xl border border-gray-900 text-gray-800 hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 transition-all text-sm dark:hover:bg-gray-900 dark:border-gray-900 dark:hover:border-gray-900 dark:text-white dark:focus:ring-gray-900 dark:focus:ring-offset-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                </svg>
                                {{ block.data.title }}


                            </button>

                        </div>
                    </template>
                </div>
                <!-- End Content -->
            </div>
        </div>
        <!-- End Blog Article -->

        <!-- Sticky Share Group -->
        <!-- End Sticky Share Group -->

    </AdminLayout>

</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Show",
    data() {
        return {
            userData: this.$page.props.auth.user,
        }
    },
    props: [
        'user'
    ],
    components: {
        AdminLayout,
        Link,
    },
    methods: {
        downloadFile(url) {
            window.open(url, '_blank');
        },
        textLimit(text, symbols) {
            if (text.length > symbols) {
                let LimitedText
                LimitedText = text.substring(0, symbols)
                return LimitedText + "..."
            }
            return text
        },


    },
}
</script>


<style scoped>

</style>
