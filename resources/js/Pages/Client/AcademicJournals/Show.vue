<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import {Head, Link} from "@inertiajs/vue3";
import FsLightbox from "fslightbox-vue/v3";
import ClientScrollTimeline from "@/Components/ClientScrollTimeline.vue";
import ClientFooterDown from "@/Components/ClientFooterDown.vue";
import AdminIndexSearch from "@/Components/AdminIndexSearch.vue";
import AdminIndexFilter from "@/Components/AdminIndexFilter.vue";
import AdminIndexHeader from "@/Components/AdminIndexHeader.vue";
import AdminIndexHeaderTitle from "@/Components/AdminIndexHeaderTitle.vue";
import ClientPostFilter from '@/Components/ClientPostFilter.vue';
import ClientPost from '@/Components/ClientPost.vue';
import ClientPostSearch from '@/Components/ClientPostSearch.vue';
import ClientImageSlider from "@/Components/ClientImageSlider.vue";

export default {
  name: "Show",
  components: {
		ClientImageSlider,
    AdminIndexHeaderTitle, AdminIndexHeader,
    AdminIndexFilter, AdminIndexSearch,
    ClientFooterDown,
    ClientScrollTimeline,
    ClientPostFilter,
    Link,
    MainNavbar,
    FsLightbox,
    Head,
    ClientPost,
    ClientPostSearch
  },
  data() {
    return {

    };
  },
  props: {
		journal: {
			type: Object
		},
		journals: {
			type: Object
		},
		years: {
			type: Object
		},
  },
  methods: {
		transformToColumns(originalArray) {
			const chunkArray = (arr, size) => {
				return arr.reduce((acc, _, i) => (i % size ? acc : [...acc, arr.slice(i, i + size)]), []);
			};

			const dividedArrays = chunkArray(originalArray, Math.ceil(originalArray.length / 2));

			return dividedArrays.reverse();
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
  mounted() {
  }
};
</script>

<template>
  <Head>
    <title>Журнал</title>
    <meta name="description" content="Your page description"/>
  </Head>
  <ClientScrollTimeline/>
  <MainNavbar class="border-b" :sections="$page.props.navigation"></MainNavbar>
  <div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:py-10">
    <div class="w-100">
      <div>
        <!-- Avatar Media -->
        <!-- End Avatar Media -->
        <!-- Content -->
        <div class="space-y-5 md:space-y-4">
					<h1 class="text-brand-primary text-center mb-3 mt-2 text-3xl font-semibold tracking-tight dark:text-white lg:text-[40px] lg:leading-tight">
						{{ journal.data.title }}
					</h1>
          <div class="space-y-5 md:space-y-4">
            <div>
							<div class="">
								<nav class="-mb-0.5 flex justify-center gap-x-6" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
									<button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none active" id="horizontal-alignment-item-1" aria-selected="true" data-hs-tab="#horizontal-alignment-1" aria-controls="horizontal-alignment-1" role="tab">
										Основная информация журнала
									</button>
									<button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none" id="horizontal-alignment-item-2" aria-selected="false" data-hs-tab="#horizontal-alignment-2" aria-controls="horizontal-alignment-2" role="tab">
										Редакция
									</button>
									<button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none" id="horizontal-alignment-item-3" aria-selected="false" data-hs-tab="#horizontal-alignment-3" aria-controls="horizontal-alignment-3" role="tab">
										Информация для авторов
									</button>
									<button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none" id="horizontal-alignment-item-3" aria-selected="false" data-hs-tab="#horizontal-alignment-4" aria-controls="horizontal-alignment-4" role="tab">
										Архив
									</button>

								</nav>
							</div>

							<div class="container px-8 xl:px-5 py-5 lg:py-8 w-4/5 mx-auto">
								<div id="horizontal-alignment-1" role="tabpanel" aria-labelledby="horizontal-alignment-item-1">
									<template v-for="block in journal.data.main_info" :key="block.id">
										<div v-if="block.type === 'heading'">
											<h2 class="font-bold text-xl">{{ block.data.content }}</h2>
										</div>
										<div class="text-[15px] text-[#374151] paragraph-container leading-8 font-light" v-html="block.data.content" v-if="block.type === 'paragraph'"></div>
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
								</div>
								<div id="horizontal-alignment-2" class="hidden w-full" role="tabpanel" aria-labelledby="horizontal-alignment-item-2">
									<template v-for="block in journal.data.chief_editor" :key="block.id">
										<div class="w-full rounded-xl mb-4 p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
											<div class="flex items-center gap-x-4">
<!--												<img loading="lazy" class="rounded-xl w-[150px]" :src="'/storage/' + worker.details.photo" alt="Image Description">-->
												<div class="grow">
													<p class="font-medium text-gray-800 hover:text-gray-500 underline">
														Главный редактор: {{ block.name }}
													</p>
													<p class="text-xs text-gray-500 mt-2">
														Ученая степень: {{ block.academicTitle }}
													</p>
													<p class="text-xs text-gray-500 mt-2">
														Должность: {{ block.position }}
													</p>
													<p class="text-xs text-gray-500 mt-2">
														Учереждение: {{ block.institution }}
													</p>
												</div>
											</div>

											<!-- Social Brands -->
											<!-- End Social Brands -->
										</div>

									</template>
									<template v-for="block in journal.data.editors" :key="block.id">
										<div class="w-full rounded-xl mb-4 p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
											<div class="flex items-center gap-x-4">
												<!--												<img loading="lazy" class="rounded-xl w-[150px]" :src="'/storage/' + worker.details.photo" alt="Image Description">-->
												<div class="grow">
													<p class="font-medium text-gray-800 hover:text-gray-500">
														{{ block.name }}
													</p>
													<p class="text-xs text-gray-500 mt-2">
														Ученая степень: {{ block.academicTitle }}
													</p>
													<p class="text-xs text-gray-500 mt-2">
														Должность: {{ block.position }}
													</p>
													<p class="text-xs text-gray-500 mt-2">
														Учереждение: {{ block.institution }}
													</p>
												</div>
											</div>

											<!-- Social Brands -->
											<!-- End Social Brands -->
										</div>

									</template>


								</div>
								<div id="horizontal-alignment-3" class="hidden" role="tabpanel" aria-labelledby="horizontal-alignment-item-3">
									<template v-for="block in journal.data.for_authors" :key="block.id">
										<div v-if="block.type === 'heading'">
											<h2 class="font-bold text-xl">{{ block.data.content }}</h2>
										</div>
										<div class="text-[16px] text-[#374151] paragraph-container leading-8 font-light" v-html="block.data.content" v-if="block.type === 'paragraph'"></div>
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
								</div>
								<div id="horizontal-alignment-4" class="hidden" role="tabpanel" aria-labelledby="horizontal-alignment-item-4">
									<!-- List -->
									<!-- Card Section -->
									<div class="px-4 py-5 sm:px-6 lg:px-8 lg:py-7 mx-auto">
										<!-- Grid -->
										<div class="">
											<template v-for="journalByYear in journals">
												<h2 class="font-bold text-xl text-center">{{ journalByYear.year_publication }}</h2>
												<hr class="mb-4 mt-2">
												<div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6 mb-4">
													<template v-for="item in journalByYear.journalIssues">
														<a target="_blank" class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition" :href="'/storage/' + item.path_file">
															<div class="p-4 md:p-5">
																<div class="flex justify-between items-center gap-x-3">
																	<div class="grow">
																		<p class="text-sm text-gray-500">
																			{{ item.year_publication }}
																		</p>
																		<h3 class="group-hover:text-blue-600 font-semibold text-gray-800">
																			{{ item.title }}
																		</h3>
																	</div>
																	<div>
																		<svg class="shrink-0 size-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
																	</div>
																</div>
															</div>
														</a>
													</template>
												</div>
											</template>

										</div>
										<!-- End Grid -->
									</div>
									<!-- End Card Section -->									<!-- End List -->
								</div>

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

.paragraph-container ol li {
	@apply list-decimal list-inside
}

.paragraph-container ul li {
	@apply list-disc list-inside
}

.paragraph-container li ol {
	@apply ml-10
}

.paragraph-container ul {
	@apply mb-2
}

</style>
