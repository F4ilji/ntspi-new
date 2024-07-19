<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import {Head, Link} from "@inertiajs/vue3";
import FsLightbox from "fslightbox-vue/v3";
import ClientScrollTimeline from "@/Components/ClientScrollTimeline.vue";
import ClientFooterDown from "@/Components/ClientFooterDown.vue";
import ClientImageSlider from "@/Components/ClientImageSlider.vue";


export default {
  name: "Show",
  components: {ClientImageSlider, ClientFooterDown, ClientScrollTimeline, Link, MainNavbar, FsLightbox, Head},
  data() {
    return {
      blocks: this.post.data.content,
      toggler: false,
      togglerGallery: false,
      editorImages: [],
      galleryImages: [],
      slide: 1,
      gallerySlide: 1,
    }
  },

	props: {
    post: {
      type: Array,
    },
		navigation: {
			type: Array,
		},
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

	},

}
</script>

<template>
  <Head>
    <title>{{ post.data.title }}</title>
    <meta name="description" content="Your page description">
  </Head>
  <ClientScrollTimeline/>
	<MainNavbar :sections="this.navigation"></MainNavbar>
  <div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
    <div class="max-w-3xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
      <div>




        <!-- Avatar Media -->
        <!-- End Avatar Media -->
        <!-- Content -->
        <div class="space-y-5 md:space-y-10">
          <div class="space-y-3">
						<a onclick="history.back()" class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-blue-500" href="#">
							<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
							Назад
						</a>
            <h1 class="text-brand-primary mb-3 mt-2 text-3xl font-semibold tracking-tight dark:text-white lg:text-[40px] lg:leading-tight">
              {{ post.data.title }}
						</h1>
          </div>


          <div class="flex space-x-3 text-gray-500 ">
            <div class="flex items-center gap-3">
              <div>

                <div class="flex items-center space-x-2 text-sm">
									<div class="col-start-2 text-center">
										<div class="hs-tooltip inline-block">
											<button type="button" class="hs-tooltip-toggle underline hover:text-blue-400 duration-300">
												Над статьей работали
												<span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute duration-300 invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
          								<template v-for="author in post.data.authors">
														{{ author }} <br>
													</template>
        								</span>
											</button>
										</div>
									</div>
                  <time class="text-gray-500 dark:text-gray-400">&bull; {{ post.data.created_post }} &bull;
                  </time>
                  <span>Чтение займет {{ post.data.reading_time }}<!-- --> Минуты</span></div>
              </div>
            </div>
          </div>



          <template v-for="block in this.blocks" :key="block.id">
						<div v-if="block.type === 'heading'">
							<h2 class="font-bold text-xl">{{ block.data.content }}</h2>
						</div>
            <div class="text-[16px] text-[#374151] dark:text-gray-200 leading-8 font-light" v-html="block.data.content" v-if="block.type === 'paragraph'"></div>
						<div v-if="block.type === 'image'">
							<ClientImageSlider :images="block.data.url" />
						</div>
						<div v-if="block.type === 'files'">
              <div class="flex border rounded-lg px-4 py-2 items-center justify-between">
                <div class="flex items-center">
                  <div class="w-[35px] h-[35px] bg-black flex justify-center items-center rounded-xl mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"
                            stroke="white"/>
                    </svg>
                  </div>
                  <div>{{ block.data.title }}</div>
                </div>

                <a :href="'/storage/'+ block.data.path" download type="button"
                   class="w-[35px] h-[35px] flex bg-gray-100 rounded-lg justify-center items-center hover:bg-gray-200 duration-200">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                       stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                  </svg>
                </a>
              </div>
            </div>
          </template>
          <div v-if="galleryImages.length" class="grid gap-4 border-t border-gray-300 py-4">
            <div class="relative">
              <img
                  class="filter brightness-[0.7] w-full max-h-[500px] object-cover rounded-lg hover:opacity-95 hover:duration-200 transition"
                  :src="galleryImages[0]" data-hs-overlay="#hs-large-modal" alt="">
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

    <div style="z-index: 100" id="hs-large-modal"
         class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
      <div
          class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all lg:max-w-4xl lg:w-full m-3 lg:mx-auto">
        <div
            class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
          <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
            <h3 class="font-bold text-gray-800 dark:text-white">
              Галлерея: {{ post.data.title }}
            </h3>
            <button type="button"
                    class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800"
                    data-hs-overlay="#hs-large-modal">
              <span class="sr-only">Close</span>
              <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                   xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                    fill="currentColor"/>
              </svg>
            </button>
          </div>
          <div class="p-4 overflow-y-auto">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

            </div>

          </div>
        </div>
      </div>
    </div>


  </div>
  <ClientFooterDown/>

</template>

<style>




</style>