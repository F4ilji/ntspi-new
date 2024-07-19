<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import {Head, Link} from "@inertiajs/vue3";
import FsLightbox from "fslightbox-vue/v3";
import ClientScrollTimeline from "@/Components/ClientScrollTimeline.vue";
import ClientFooterDown from "@/Components/ClientFooterDown.vue";
import ClientPostFilter from "@/Components/ClientPostFilter.vue";
import ClientPost from "@/Components/ClientPost.vue";
import AdminIndexHeader from "@/Components/AdminIndexHeader.vue";
import ClientPostSearch from "@/Components/ClientPostSearch.vue";


export default {
  name: "Show",
  components: {
		ClientPostSearch,
		AdminIndexHeader,
		ClientPost,
		ClientPostFilter,
		ClientFooterDown, ClientScrollTimeline, Link, MainNavbar, FsLightbox, Head},
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
  props: {
    program: {
      type: Array,
    },
    mainSections: {
      type: Array
    },

  },
  methods: {
		getFormOfStudy(contests) {
			const formOfStudyArray = Array.from(new Set(contests.map(item => item.form_of_study)));

			return formOfStudyArray;
		}

  },
}
</script>

<template>
  <Head>
    <title>Образовательная программа</title>
    <meta name="description" content="Your page description">
  </Head>
  <ClientScrollTimeline/>
  <MainNavbar class="border-b" :sections="this.mainSections"></MainNavbar>
	<div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
		<div class="px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
			<div>
				<!-- Avatar Media -->
				<!-- End Avatar Media -->
				<!-- Content -->
				<div class="space-y-5 md:space-y-4">
					<div class="space-y-5 md:space-y-4">
						<div>
							<div class="container px-8 mx-auto xl:px-5 max-w-screen-lg py-5 lg:py-8">
								<div class="space-y-3 flex flex-col items-center justify-center">
									<div class="inline-flex mx-auto items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-200 bg-white text-gray-800 shadow-sm dark:bg-slate-900 dark:border-gray-700 dark:text-white">{{ program.data.degree }}</div>
									<h1 class="text-2xl font-bold md:text-4xl">{{ program.data.name }}</h1>
								</div>
								<!-- Icon Blocks -->
								<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
									<div class="grid sm:grid-cols-2 lg:grid-cols-4 items-start gap-12">
										<!-- Icon Block -->
										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="10" height="14" x="3" y="8" rx="2"/><path d="M5 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2h-2.4"/><path d="M8 18h.01"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Направление подготовки</h3>
												<p class="mt-1 text-gray-600">{{ program.data.napr.name }}</p>
											</div>
										</div>
										<!-- End Icon Block -->

										<!-- Icon Block -->
										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7h-9"/><path d="M14 17H5"/><circle cx="17" cy="17" r="3"/><circle cx="7" cy="7" r="3"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Срок обучения</h3>
												<p class="mt-1 text-gray-600">{{ program.data.studyPeriod }}</p>
											</div>
										</div>
										<!-- End Icon Block -->

										<!-- Icon Block -->
										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Форма обучения</h3>
												<template v-for="form in getFormOfStudy(program.data.contests)">
													<p class="mt-1 text-gray-600">{{ form }}</p>
												</template>
											</div>
										</div>
										<!-- End Icon Block -->

										<!-- Icon Block -->
										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Количество мест на прием</h3>
												<template v-for="contest in program.data.contests">
													<p class="mt-1 text-gray-600">{{ contest.count_places }} {{ contest.source }}</p>
												</template>
											</div>
										</div>
										<!-- End Icon Block -->
									</div>
								</div>

								<div>


								</div>

								<div>
									<div class="hs-accordion-group">
										<div class="hs-accordion bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg" id="hs-bordered-heading-one">
											<button class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none" aria-controls="hs-basic-bordered-collapse-two">
												<svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
													<path d="M5 12h14"></path>
													<path d="M12 5v14"></path>
												</svg>
												<svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
													<path d="M5 12h14"></path>
												</svg>
												Вступительные испытания
											</button>
											<div id="hs-basic-bordered-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-bordered-heading-two">
												<div class="pb-4 px-5">
													<ol class="list-decimal list-inside">
														<template v-for="exam in program.data.exams">
															<li>{{ exam.name }} <span class="opacity-40">(минимальный балл: {{ exam.min_ball }})</span></li>
														</template>
													</ol>
												</div>
											</div>
										</div>

										<div class="hs-accordion bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg" id="hs-bordered-heading-two">
											<button class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none" aria-controls="hs-basic-bordered-collapse-two">
												<svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
													<path d="M5 12h14"></path>
													<path d="M12 5v14"></path>
												</svg>
												<svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
													<path d="M5 12h14"></path>
												</svg>
												О программе
											</button>
											<div id="hs-basic-bordered-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-bordered-heading-two">
												<div class="pb-4 px-5">
													<p class="text-gray-800">
														<em>This is the second item's accordion body.</em> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
													</p>
												</div>
											</div>
										</div>

										<div class="hs-accordion bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg" id="hs-bordered-heading-three">
											<button class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none" aria-controls="hs-basic-bordered-collapse-three">
												<svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
													<path d="M5 12h14"></path>
													<path d="M12 5v14"></path>
												</svg>
												<svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
													<path d="M5 12h14"></path>
												</svg>
												Особенности программы
											</button>
											<div id="hs-basic-bordered-collapse-three" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-bordered-heading-three">
												<div class="pb-4 px-5">
													<p class="text-gray-800">
														<em>This is the first item's accordion body.</em> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- End Icon Blocks -->

							</div>
						</div>
					</div>
				</div>
				<!-- End Content -->
			</div>
		</div>
	</div>
  <ClientFooterDown/>

</template>

<style scoped>


</style>