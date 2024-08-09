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

    }
  },
  props: {
		additionalEducation: {
      type: Object,
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
									<h1 class="text-2xl text-center font-bold md:text-4xl">{{ additionalEducation.data.title }}</h1>
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
												<p class="mt-1 text-gray-600">{{ additionalEducation.data.directionAdditionalEducation.title }} {{ additionalEducation.data.category }}</p>
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
													<p class="mt-1 text-gray-600">{{ additionalEducation.data.learning_time }} часов</p>
											</div>
										</div>
										<!-- End Icon Block -->

										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Присваиваемая квалификация</h3>
													<p class="mt-1 text-gray-600">{{ additionalEducation.data.qualification }}</p>
											</div>
										</div>

										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Форма обучения</h3>
												<p class="mt-1 text-gray-600">{{ additionalEducation.data.form_education }}</p>
											</div>
										</div>

										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Цена обучения</h3>
												<p class="mt-1 text-gray-600">{{ additionalEducation.data.price }} &#8381;</p>
											</div>
										</div>

										<div class="text-center">
											<div class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto">
												<svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
											</div>
											<div class="mt-3">
												<h3 class="text-lg font-semibold text-gray-800">Целевая аудитория</h3>
												<p class="mt-1 text-gray-600">{{ additionalEducation.data.target_group }}</p>
											</div>
										</div>



										<!-- End Icon Block -->
									</div>
								</div>

								<div class="space-y-3 flex flex-col mb-[50px] items-center justify-center">
									<button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
										Оставить заявку на консультацию
									</button>
								</div>

								<div>


								</div>

								<div>
									<h2 class="text-xl font-bold md:text-2xl">О программе</h2>
									<div class="py-4 px-5">
										<template v-for="block in this.additionalEducation.data.content" :key="block.id">
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
											<div class="mb-4" v-if="block.type === 'heading'">
												<h2 class="font-bold text-xl">{{ block.data.content }}</h2>
											</div>
											<div v-if="block.type === 'image'">
												<template v-for="img in block.data.url">
													<img loading="lazy" class="mx-auto object-cover rounded-sm hover:opacity-95 hover:duration-200 transition" :src="'/storage/' + img" alt="">
												</template>
											</div>
											<div class="text-[16px] text-[#374151] leading-8 font-light paragraph-container" v-html="block.data.content" v-if="block.type === 'paragraph'"></div>


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
	@apply mb-6
}


</style>