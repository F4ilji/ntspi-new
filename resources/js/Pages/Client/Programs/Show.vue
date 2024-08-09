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
			const formOfStudyArray = Array.from(new Set(contests.map(item => item.form_edu)));

			return formOfStudyArray;
		},
		getYearOfStudy(contests) {
			const YearOfStudyArray = Array.from(new Set(contests.map(item => item.period_data)));

			return YearOfStudyArray;
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
  <MainNavbar class="border-b" :sections="$page.props.navigation"></MainNavbar>
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
								<a onclick="history.back()" class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-blue-500" href="#">
									<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
									Назад
								</a>
								<div class="space-y-3 flex flex-col items-center justify-center">
									<div class="inline-flex mx-auto items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-200 bg-white text-gray-800 shadow-sm dark:bg-slate-900 dark:border-gray-700 dark:text-white">{{ program.data.lvl_edu }}</div>
									<h1 class="text-2xl text-center font-bold md:text-4xl">{{ program.data.name }}</h1>
								</div>
								<!-- Icon Blocks -->
								<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
									<div class="grid sm:grid-cols-2 lg:grid-cols-3 items-start gap-12">
										<!-- Icon Block -->
										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="10" height="14" x="3" y="8" rx="2"/><path d="M5 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2h-2.4"/><path d="M8 18h.01"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Направление подготовки</h3>
												<p class="mt-1 text-gray-600">{{ program.data.directionStudy.name }} {{ program.data.directionStudy.code }}</p>
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
												<template v-for="data in program.data.learning_forms">
													<p class="mt-1 text-gray-600">{{ data.period_data }} <span class="text-gray-400 text-[12px]">({{ data.form_edu }})</span> </p>
												</template>
											</div>
										</div>
										<!-- End Icon Block -->

										<!-- Icon Block -->
<!--										<div class="text-center">-->
<!--											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">-->
<!--												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>-->
<!--											</div>-->
<!--											<div class="mt-3">-->
<!--												<h3 class="text-lg font-semibold text-gray-800">Форма обучения</h3>-->
<!--												<template v-for="form in getFormOfStudy(program.data.learning_forms)">-->
<!--													<p class="mt-1 text-gray-600">{{ form }}</p>-->
<!--												</template>-->
<!--											</div>-->
<!--										</div>-->
										<!-- End Icon Block -->



										<!-- Icon Block -->
										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Количество мест на прием</h3>
												<template v-for="admissionPlan in program.data.admissionPlans">
													<template v-for="contest in admissionPlan.contests">
														<div class="border rounded my-2 py-1">
															<span class="text-gray-500 text-[14px]">{{ (contest.form_education === 'och') ? 'Очная форма обучения' : 'Заочная форма обучения' }}</span>
															<p v-if="contest.budget_quantity_position != null" class="mt-1 text-gray-600">{{ contest.budget_quantity_position }} мест <span class="text-gray-400 text-[12px]">(Бюджет)</span></p>
															<p v-if="contest.non_budget_quantity_position != null" class="mt-1 text-gray-600">{{ contest.non_budget_quantity_position }} мест <span class="text-gray-400 text-[12px]">(С оплатной обучения)</span></p>
														</div>
													</template>
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
												Условия поступления
											</button>
											<div id="hs-basic-bordered-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-bordered-heading-two">
												<div class="pb-4 px-5">
													<ol class="list-decimal list-inside">
														<template v-for="admissionPlan in program.data.admissionPlans">
															<template v-for="exam in admissionPlan.exams">
																<li>{{ exam.title }} <span class="text-gray-400 text-[14px]">({{ (exam.type_exam === 'ege' ? 'ЕГЭ' : 'ВИ') }}, минимальный балл: {{ exam.min_score }})</span></li>
															</template>
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
													<template v-for="block in this.program.data.about_program" :key="block.id">
														<!--						<div v-if="block.type === 'image'">-->
														<!--							<figure :class="block.data.withBackground ? 'bg-gray-100 rounded-lg' : ''">-->
														<!--								<img loading="lazy" @click="openEditorImagesOnSlide(block.slideNumber)"-->
														<!--									 :src="block.data.file.url"-->
														<!--									 :class="block.data.withBackground ? 'rounded-none' : 'w-full'"-->
														<!--									 class="mx-auto max-h-[350px] object-cover rounded-lg hover:opacity-95 hover:duration-200 transition"-->
														<!--									 :alt="block.data.caption">-->
														<!--								<figcaption class="mt-3 text-sm text-center text-gray-500">-->
														<!--									{{ block.data.caption }}-->
														<!--								</figcaption>-->
														<!--							</figure>-->
														<!--						</div>-->
														<div v-if="block.type === 'heading'">
															<h2 class="font-bold text-xl">{{ block.data.content }}</h2>
														</div>
														<div v-if="block.type === 'image'">
															<template v-for="img in block.data.url">
																<img loading="lazy" class="mx-auto object-cover rounded-sm hover:opacity-95 hover:duration-200 transition" :src="'/storage/' + img" alt="">
															</template>
														</div>
														<div class="paragraph-container" v-html="block.data.content" v-if="block.type === 'paragraph'" />


														<div v-if="block.type === 'attaches'">
															<div class="flex border rounded-lg px-4 py-2 items-center justify-between">
																<div class="flex items-center">
																	<div class="w-[35px] h-[35px] bg-black flex justify-center items-center rounded-xl mr-2">
																		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
																				 stroke-width="1.5"
																				 stroke="currentColor" class="w-6 h-6">
																			<path stroke-linecap="round" stroke-linejoin="round"
																						d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"
																						stroke="white"/>
																		</svg>
																	</div>
																	<div>{{ block.data.title }}</div>
																</div>

																<a :href="block.data.file.url" download type="button"
																	 class="w-[35px] h-[35px] flex bg-gray-100 rounded-lg justify-center items-center hover:bg-gray-200 duration-200">
																	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
																			 stroke-width="1.5"
																			 stroke="currentColor" class="w-6 h-6">
																		<path stroke-linecap="round" stroke-linejoin="round"
																					d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
																	</svg>
																</a>
															</div>
														</div>
														<div v-if="block.type === 'linkTool'">
															<div v-if="block.data.meta.type === 'post'" class="w-full mx-auto">
																<a class="group relative block rounded-xl dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" :href="block.data.link">
																	<div class="flex-shrink-0 relative w-full rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:w-full before:h-full before:bg-gradient-to-t before:from-gray-900/[.7] before:z-[1]">
																	</div>

																	<div class="absolute top-0 inset-x-0 z-10">
																		<div class="p-4 flex flex-col h-full sm:p-6">
																			<!-- Avatar -->
																			<div class="flex items-center">
																				<div class="ms-2.5 sm:ms-4">
																					<h4 class="font-semibold text-white">
																						{{ block.data.meta.data.authors[0].name }}
																					</h4>
																					<p class="text-xs text-white/[.8]">
																						{{ block.data.meta.data.created_post }}
																					</p>
																				</div>
																			</div>
																			<!-- End Avatar -->
																		</div>
																	</div>

																	<div class="absolute bottom-0 inset-x-0 z-10">
																		<div class="flex flex-col h-full p-4 sm:p-6">
																			<h3 class="text-lg sm:text-3xl font-semibold text-white group-hover:text-white/[.8]">
																				{{ block.data.meta.data.title }}
																			</h3>
																			<p class="mt-2 text-white/[.8]">
																				{{ textLimit(block.data.meta.description, 200) }}
																			</p>
																		</div>
																	</div>
																</a>
															</div>
															<!-- End Card Blog -->
															<div v-if="block.data.meta.type === 'student'" class="flex flex-col rounded-xl p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
																<div class="flex items-center gap-x-4">
																	<img loading="lazy" class="rounded-xl w-[150px]" :src="block.data.meta.data.photo" alt="Image Description">
																	<div class="grow">
																		<Link :href="block.data.link" class="font-medium text-gray-800 hover:text-gray-500 underline">
																			{{ block.data.meta.title }}
																		</Link>
																		<p class="text-xs text-gray-500 mt-2">
																			{{ block.data.meta.data.position }}
																		</p>
																		<p class="text-xs text-gray-500 mt-2">
																			{{ block.data.meta.data.contactEmail }} / <a :href="block.data.meta.data.vk_link">Вконтакте</a>
																		</p>
																	</div>
																</div>

																<!-- Social Brands -->
																<!-- End Social Brands -->
															</div>
														</div>

													</template>
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
													<template v-for="block in this.program.data.program_features" :key="block.id">
														<!--						<div v-if="block.type === 'image'">-->
														<!--							<figure :class="block.data.withBackground ? 'bg-gray-100 rounded-lg' : ''">-->
														<!--								<img loading="lazy" @click="openEditorImagesOnSlide(block.slideNumber)"-->
														<!--									 :src="block.data.file.url"-->
														<!--									 :class="block.data.withBackground ? 'rounded-none' : 'w-full'"-->
														<!--									 class="mx-auto max-h-[350px] object-cover rounded-lg hover:opacity-95 hover:duration-200 transition"-->
														<!--									 :alt="block.data.caption">-->
														<!--								<figcaption class="mt-3 text-sm text-center text-gray-500">-->
														<!--									{{ block.data.caption }}-->
														<!--								</figcaption>-->
														<!--							</figure>-->
														<!--						</div>-->
														<div v-if="block.type === 'heading'">
															<h2 class="font-bold text-xl">{{ block.data.content }}</h2>
														</div>
														<div v-if="block.type === 'image'">
															<template v-for="img in block.data.url">
																<img loading="lazy" class="mx-auto object-cover rounded-sm hover:opacity-95 hover:duration-200 transition" :src="'/storage/' + img" alt="">
															</template>
														</div>
														<div class="paragraph-container" v-html="block.data.content" v-if="block.type === 'paragraph'" />


														<div v-if="block.type === 'attaches'">
															<div class="flex border rounded-lg px-4 py-2 items-center justify-between">
																<div class="flex items-center">
																	<div class="w-[35px] h-[35px] bg-black flex justify-center items-center rounded-xl mr-2">
																		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
																				 stroke-width="1.5"
																				 stroke="currentColor" class="w-6 h-6">
																			<path stroke-linecap="round" stroke-linejoin="round"
																						d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"
																						stroke="white"/>
																		</svg>
																	</div>
																	<div>{{ block.data.title }}</div>
																</div>

																<a :href="block.data.file.url" download type="button"
																	 class="w-[35px] h-[35px] flex bg-gray-100 rounded-lg justify-center items-center hover:bg-gray-200 duration-200">
																	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
																			 stroke-width="1.5"
																			 stroke="currentColor" class="w-6 h-6">
																		<path stroke-linecap="round" stroke-linejoin="round"
																					d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
																	</svg>
																</a>
															</div>
														</div>
														<div v-if="block.type === 'linkTool'">
															<div v-if="block.data.meta.type === 'post'" class="w-full mx-auto">
																<a class="group relative block rounded-xl dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" :href="block.data.link">
																	<div class="flex-shrink-0 relative w-full rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:w-full before:h-full before:bg-gradient-to-t before:from-gray-900/[.7] before:z-[1]">
																	</div>

																	<div class="absolute top-0 inset-x-0 z-10">
																		<div class="p-4 flex flex-col h-full sm:p-6">
																			<!-- Avatar -->
																			<div class="flex items-center">
																				<div class="ms-2.5 sm:ms-4">
																					<h4 class="font-semibold text-white">
																						{{ block.data.meta.data.authors[0].name }}
																					</h4>
																					<p class="text-xs text-white/[.8]">
																						{{ block.data.meta.data.created_post }}
																					</p>
																				</div>
																			</div>
																			<!-- End Avatar -->
																		</div>
																	</div>

																	<div class="absolute bottom-0 inset-x-0 z-10">
																		<div class="flex flex-col h-full p-4 sm:p-6">
																			<h3 class="text-lg sm:text-3xl font-semibold text-white group-hover:text-white/[.8]">
																				{{ block.data.meta.data.title }}
																			</h3>
																			<p class="mt-2 text-white/[.8]">
																				{{ textLimit(block.data.meta.description, 200) }}
																			</p>
																		</div>
																	</div>
																</a>
															</div>
															<!-- End Card Blog -->
															<div v-if="block.data.meta.type === 'student'" class="flex flex-col rounded-xl p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
																<div class="flex items-center gap-x-4">
																	<img loading="lazy" class="rounded-xl w-[150px]" :src="block.data.meta.data.photo" alt="Image Description">
																	<div class="grow">
																		<Link :href="block.data.link" class="font-medium text-gray-800 hover:text-gray-500 underline">
																			{{ block.data.meta.title }}
																		</Link>
																		<p class="text-xs text-gray-500 mt-2">
																			{{ block.data.meta.data.position }}
																		</p>
																		<p class="text-xs text-gray-500 mt-2">
																			{{ block.data.meta.data.contactEmail }} / <a :href="block.data.meta.data.vk_link">Вконтакте</a>
																		</p>
																	</div>
																</div>

																<!-- Social Brands -->
																<!-- End Social Brands -->
															</div>
														</div>

													</template>
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

<style>

.paragraph-container a {
	@apply text-[#1E57A3];
	@apply underline;
}

.paragraph-container p {
	@apply mb-2
}


</style>