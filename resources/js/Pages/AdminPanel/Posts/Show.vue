<template>
    <AdminLayout>

        <!-- Blog Article -->
        <div class="max-w-3xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
            <div class="max-w-2xl">
                <!-- Avatar Media -->
                <!-- End Avatar Media -->
                <Link :href="route('admin.post.index')" class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-blue-400 mb-6">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Вернуться к новостям
                </Link>
                <!-- Content -->
                <div class="space-y-5 md:space-y-4">
                    <div class="space-y-3">
                        <h2 class="text-2xl font-bold md:text-3xl dark:text-white">{{ post.data.title }}</h2>
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
                                            {{ textLimit(post.data.title, 15) }}
                                        </li>
                                    </ol>
                                    <div class="flex items-center">
                                        <ul class="block text-xs text-gray-500  mr-3">
                                            <li class="inline-block relative pr-6 last:pr-0 last-of-type:before:hidden before:absolute before:top-1/2 before:right-2 before:-translate-y-1/2 before:w-1 before:h-1 before:bg-gray-300 before:rounded-full dark:text-gray-400 dark:before:bg-gray-600">
                                                Опубликовано: {{ post.data.created_post }}
                                            </li>
                                        </ul>
                                        <div class="hs-tooltip [--trigger:hover] [--placement:bottom]">
                                            <div class="hs-tooltip-toggle sm:mb-1 block text-left cursor-pointer">
                                            <span class="font-normal text-sm text-gray-800 dark:text-gray-200 underline hover:text-gray-500">
                                                {{ post.data.authors.length === 0 ? '' : textLimit(post.data.authors[0].name, 10) }}
                                            </span>
                                                <!-- Dropdown Card -->
                                                <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 max-w-xs cursor-default bg-gray-900 divide-y divide-gray-700 shadow-lg rounded-xl dark:bg-black" role="tooltip">
                                                    <!-- Body -->
                                                    <div class="p-4 sm:p-5">
                                                        <div class="mb-2 flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                                                            <div class="grow">
                                                                <p class="text-lg font-semibold text-gray-200">
                                                                    {{ post.data.authors.length === 0 ? '' : post.data.authors[0].name }}
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

                    <template v-for="block in blocksWithSlideNumber">
                        <div v-if="block.type === 'image'">
                            <figure>
                                <img loading="lazy" @click="openEditorImagesOnSlide(block.slideNumber)" :src="block.data.file.url" class="w-full max-h-[500px] object-cover rounded-xl hover:opacity-95 hover:duration-200 transition" :alt="block.data.caption">
                                <figcaption class="mt-3 text-sm text-center text-gray-500">
                                    {{ block.data.caption }}
                                </figcaption>
                            </figure>
                        </div>
                        <div v-if="block.type === 'paragraph'">
                            <p class="text-[16px] text-gray-800 dark:text-gray-200 text-justify">{{ block.data.text }}</p>
                        </div>
                        <div class="" v-if="block.type === 'list'">
                            <ul class="list-inside" :class="{ 'list-disc': block.data.style === 'unordered'  }">
                                <li class="text-[16px] text-gray-800 dark:text-gray-200 text-justify" v-for="item in block.data.items" v-html="item"></li>
                            </ul>
                        </div>
                        <div v-if="block.type === 'attaches'">
                            <div class="flex border rounded-lg px-4 py-2 items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-[35px] h-[35px] bg-black flex justify-center items-center rounded-xl mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" stroke="white" /> </svg>
                                    </div>
                                    <div>{{ block.data.title }}</div>
                                </div>

                                <a :href="block.data.file.url" download type="button" class="w-[35px] h-[35px] flex bg-gray-100 rounded-lg justify-center items-center hover:bg-gray-200 duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </template>
                    <div v-if="galleryImages.length" class="grid gap-4 border-t border-gray-300 py-4">
                        <div class="relative">
                            <img class="filter brightness-[0.7] w-full max-h-[500px] object-cover rounded-xl hover:opacity-95 hover:duration-200 transition" :src="galleryImages[0]" data-hs-overlay="#hs-large-modal" alt="">
                            <div class="absolute inset-x-0 bottom-5 flex flex-col justify-center items-center">
                                <p class="text-white text-sm lg:text-xl text-center">{{ post.data.title }}</p>
                                <span class="text-gray-400 text-sm">{{ galleryImages.length }} фотографий</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>

        <div id="hs-large-modal" class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all lg:max-w-4xl lg:w-full m-3 lg:mx-auto">
                <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
                        <h3 class="font-bold text-gray-800 dark:text-white">
                            Галлерея: {{ post.data.title }}
                        </h3>
                        <button type="button" class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800" data-hs-overlay="#hs-large-modal">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z" fill="currentColor"/>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <template v-for="(image, key) in galleryImages.slice()">
                                <div>
                                    <img loading="lazy" @click="openGalleryImagesOnSlide(key + 1)" class="h-[200px] w-full object-cover rounded-lg hover:scale-[1.05] hover:opacity-95 hover:duration-200 transition" :src="image" alt="">
                                </div>
                            </template>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <FsLightbox class="z-1100" :slide="gallerySlide" :toggler="togglerGallery" :sources="galleryImages" />

        <FsLightbox class="z-1000" :slide="slide" :toggler="toggler" :sources="editorImages" />

    </AdminLayout>

</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import FsLightbox from "fslightbox-vue/v3";

export default {
    name: "Show",
    data() {
        return {
            blocks: this.blocksWithSlideNumber,
            userData: this.$page.props.auth.user,
            toggler: false,
            togglerGallery: false,
            editorImages: [],
            galleryImages: [],
            slide: 1,
            gallerySlide: 1,
        }
    },
    props: [
        'post'
    ],
    components: {
        AdminLayout,
        Link,
        FsLightbox,
    },
    methods: {
        textLimit(text, symbols) {
            if (text.length > symbols) {
                let LimitedText
                LimitedText = text.substring(0, symbols)
                return LimitedText + "..."
            }
            return text
        },
        openEditorImagesOnSlide: function(number) {
            this.slide = number;
            this.toggler = !this.toggler;
        },
        openGalleryImagesOnSlide: function(number) {
            this.gallerySlide = number;
            this.togglerGallery = !this.togglerGallery;
        },

    },
    mounted() {
        this.editorImages = this.blocksWithSlideNumber
            .filter(block => block.type === 'image')
            .map(block => block.data.file.url);
        this.galleryImages = this.post.data.gallery.images
            .map(image => image.path)
    },
    computed: {
        blocksWithSlideNumber() {
            let slideNumber = 1;
            return this.post.data.content.blocks.map((block) => {
                if (block.type === "image") {
                    block.slideNumber = slideNumber;
                    slideNumber++;
                }
                return block;
            });
        },
    }
}
</script>

<style scoped>

.example-initial-animation {
    animation: initial-animation 2s ease;
}

@keyframes  initial-animation {
    0% {
        transform: rotate(0deg);
    }

    50% {
        transform: rotate(360deg);
    }

    100% {
        transform: rotate(0deg);
    }
}

</style>
