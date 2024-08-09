<template>
	<Head>
		<title>{{ department.data.title }}</title>
		<meta name="description" content="Your page description">
	</Head>
	<MainNavbar class="border-b" :sections="$page.props.navigation" />

	<div class="w-full h-[67px] fixed" id="visor"></div>

	<div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
		<div class="sticky top-[110px] hidden h-[calc(100vh-110px)] max-w-[20%] md:flex md:shrink-0 md:flex-col md:justify-between">
			<nav v-if="this.departments"
				 class="styled-scrollbar flex h-[calc(100vh-200px)] flex-col overflow-y-scroll pr-2 pb-4">
				<div class="text-gray-1000 mb-2 text-md font-medium">Кафедры факультета - {{ department.data.faculty.abbreviation }}</div>
				<div class="flex gap-x-1">
					<ul class="px-0.5 last-of-type:mb-0 mb-8">
						<li v-for="depart in this.departments.data" :key="department.id" class="my-1.5 flex">
							<a :class="{'text-white hover:text-gray-200 font-semibold bg-[#135aae]': isSameRoute(route('client.department.show', { facultySlug: department.data.faculty.slug, departmentSlug: depart.slug })), 'text-gray-600 hover:text-[#2C6288]': !isSameRoute(route('client.department.show', { facultySlug: department.data.faculty.slug, departmentSlug: depart.slug })) }"
								 :href="route('client.department.show', { facultySlug: department.data.faculty.slug, departmentSlug: depart.slug }) + '/'"
							   class="relative duration-300 flex w-full rounded-md cursor-pointer items-center px-2 py-1 text-left text-sm">{{
									depart.title
								}}</a>
						</li>
					</ul>
				</div>

			</nav>
		</div>

		<nav class="order-last hidden w-56 shrink-0 lg:block">
			<div class="sticky top-[110px] h-[calc(100vh-110px)]">
				<div class="text-gray-1000 mb-2 text-md font-medium">На этой странице</div>
				<ul class="styled-scrollbar max-h-[70vh] space-y-1.5 overflow-y-auto py-2 text-sm">
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'workers', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'workers' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#workers">Сотрудники кафедры</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'teachers', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'teachers' }"
						   class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
						   href="#teachers">Преподаватели кафедры</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'external-teachers', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'external-teachers' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#external-teachers">Внешние совместители</a>
					</li>
					<transition name="fade">
						<li class="anchor-li flex items-center py-2 border-t" v-if="scrollTop" @click.prevent="scrollToTop">
							<button class="bg-transperant text-gray-600 cursor-pointer hover:text-gray-900 duration-300 block px-2 leading-[1.6] rounded-md">К началу</button>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[17px] text-gray-600">
								<path stroke-linecap="round" stroke-linejoin="round" d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</li>
					</transition>
				</ul>
			</div>
		</nav>

		<article class="w-full min-w-0 mt-1 max-w-6xl px-1 md:px-6" style="">
			<div class="space-y-5 md:space-y-5">

				<a onclick="history.back()" class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-blue-500" href="#">
					<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
					Назад
				</a>

				<div class="flex justify-between items-center mb-6">
					<div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">
						<div class="grow">
							<div class="grid sm:flex sm:justify-between sm:items-center gap-2">
								<ol class="flex items-center whitespace-normal min-w-0"
									aria-label="Breadcrumb">
									<li class="text-sm">
										<span class="flex items-center text-gray-500 hover:text-blue-600">
											Главная
											<svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400"
												 width="16" height="16"
												 viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
													  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
											</svg>
										</span>
									</li>
									<li class="text-sm">
										<span class="flex items-center text-gray-500 hover:text-blue-600" @click.prevent>
											Факультеты
											<svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400"
												 width="16" height="16"
												 viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
													  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
											</svg>
										</span>
									</li>

								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="space-y-3">
					<h1 class="text-2xl mb-10 font-bold md:text-3xl">{{ department.data.title }}</h1>
				</div>

				<div id="page-area" class="space-y-5 md:space-y-5">

					<p class="text-[16px] text-gray-700 leading-7">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>
					<p class="text-[16px] text-gray-700 leading-7">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>
					<h2 id="workers" class="font-bold text-xl">Сотрудники кафедры</h2>
					<template v-for="worker in department.data.workers">
						<div class="flex flex-col rounded-xl p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
							<div class="flex items-center gap-x-4">
								<img loading="lazy" class="rounded-xl w-[150px]" :src="'/storage/' + worker.photo" alt="Image Description">
								<div class="grow">
									<Link :href="route('client.person.show', worker.id)" class="font-medium text-gray-800 hover:text-gray-500 underline">
										{{ worker.position }}: {{ worker.name }}
									</Link>
									<p class="text-xs text-gray-500 mt-2">
										Ученая степень: {{ worker.academicTitle }}
									</p>
									<p class="text-xs text-gray-500 mt-2">
										Контактный телефон: {{ worker.contactPhone }}
									</p>
									<p class="text-xs text-gray-500 mt-2">
										Электронная почта: {{ worker.contactEmail }}
									</p>
									<p class="text-xs text-gray-500 mt-2">
										Кабинет: 207В
									</p>
								</div>
							</div>

							<!-- Social Brands -->
							<!-- End Social Brands -->
						</div>
					</template>
					<h2 id="teachers" class="font-bold text-xl">Преподаватели кафедры</h2>
					<template v-for="teacher in department.data.teachers">
						<div class="flex flex-col rounded-xl p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
							<div class="flex items-center gap-x-4">
								<img loading="lazy" class="rounded-xl w-[150px]" :src="'/storage/' + teacher.photo" alt="Image Description">
								<div class="grow">
									<Link :href="route('client.person.show', teacher.id)" class="font-medium text-gray-800 hover:text-gray-500 underline">
										{{ teacher.position }}: {{ teacher.name }}
									</Link>
									<p v-if="teacher.academicTitle !== null" class="text-xs text-gray-500 mt-2">
										Ученая степень: {{ teacher.academicTitle }}
									</p>
									<p class="text-xs text-gray-500 mt-2">
										Контактный телефон: {{ teacher.contactPhone }}
									</p>
									<p class="text-xs text-gray-500 mt-2">
										Электронная почта: {{ teacher.contactEmail }}
									</p>
									<p class="text-xs text-gray-500 mt-2">
										Кабинет: 207В
									</p>
								</div>
							</div>

							<!-- Social Brands -->
							<!-- End Social Brands -->
						</div>
					</template>

					<!-- FAQ -->
					<div class="hs-accordion-group">

						<div class="hs-accordion hs-accordion-active:bg-gray-100 rounded-xl p-6" id="hs-basic-with-title-and-arrow-stretched-heading-three">
							<button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 focus:outline-none" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three">
								44.03.05 Педагогическое образование (с двумя профилями подготовки)
								<svg class="hs-accordion-active:hidden block shrink-0 size-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
								<svg class="hs-accordion-active:block hidden shrink-0 size-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
							</button>
							<div id="hs-basic-with-title-and-arrow-stretched-collapse-three" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three">
								<ul class="list-disc list-outside space-y-3 ps-5 text-lg text-gray-800 dark:text-neutral-200">
									<li class="ps-2"><a class="text-base text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="#">Профиль «Биология и химия»</a></li>
									<li class="ps-2"><a class="text-base text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="#">Профиль «Биология и химия»</a></li>
									<li class="ps-2"><a class="text-base text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="#">Профиль «Биология и химия»</a></li>
									<li class="ps-2"><a class="text-base text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="#">Профиль «Биология и химия»</a></li>
								</ul>
							</div>
						</div>

						<div class="hs-accordion hs-accordion-active:bg-gray-100 rounded-xl p-6" id="hs-basic-with-title-and-arrow-stretched-heading-four">
							<button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 focus:outline-none" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-four">
								44.03.01 Педагогическое образование
								<svg class="hs-accordion-active:hidden block shrink-0 size-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
								<svg class="hs-accordion-active:block hidden shrink-0 size-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
							</button>
							<div id="hs-basic-with-title-and-arrow-stretched-collapse-four" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-four">
								<p class="text-gray-800">
									Профиль «Экология» (второе высшее образование)
								</p>
							</div>
						</div>

						<div class="hs-accordion hs-accordion-active:bg-gray-100 rounded-xl p-6" id="hs-basic-with-title-and-arrow-stretched-heading-five">
							<button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 focus:outline-none" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-five">
								09.03.03 Прикладная информатика
								<svg class="hs-accordion-active:hidden block shrink-0 size-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
								<svg class="hs-accordion-active:block hidden shrink-0 size-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
							</button>
							<div id="hs-basic-with-title-and-arrow-stretched-collapse-five" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-five">
								<p class="text-gray-800">
									Профиль «Прикладная информатика в управлении IT-проектами»
								</p>
							</div>
						</div>

					</div>

					<!-- End FAQ -->


					<h2 id="external-teachers" class="font-bold text-xl">Внешние совместители</h2>

					<!-- Card Section -->
						<!-- Grid -->

						<!-- End Grid -->
					<!-- End Card Section -->

<!--										<template v-for="block in this.blocks" :key="block.id">-->
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
<!--						<div v-if="block.type === 'heading'">-->
<!--							<h2 :id="generateSlug(block.data.content)" class="font-bold text-xl">{{ block.data.content }}</h2>-->
<!--						</div>-->
<!--						<div v-if="block.type === 'image'">-->
<!--							<template v-for="img in block.data.url">-->
<!--								<img loading="lazy" class="mx-auto object-cover rounded-sm hover:opacity-95 hover:duration-200 transition" :src="'/storage/' + img" alt="">-->
<!--							</template>-->
<!--						</div>-->
<!--						<div class="text-[16px] text-[#374151] dark:text-gray-200 leading-8 font-light" v-html="block.data.content" v-if="block.type === 'paragraph'"></div>-->
<!--						<div v-if="block.type === 'attaches'">-->
<!--							<div class="flex border rounded-lg px-4 py-2 items-center justify-between">-->
<!--								<div class="flex items-center">-->
<!--									<div class="w-[35px] h-[35px] bg-black flex justify-center items-center rounded-xl mr-2">-->
<!--										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"-->
<!--											 stroke-width="1.5"-->
<!--											 stroke="currentColor" class="w-6 h-6">-->
<!--											<path stroke-linecap="round" stroke-linejoin="round"-->
<!--												  d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"-->
<!--												  stroke="white"/>-->
<!--										</svg>-->
<!--									</div>-->
<!--									<div>{{ block.data.title }}</div>-->
<!--								</div>-->

<!--								<a :href="block.data.file.url" download type="button"-->
<!--								   class="w-[35px] h-[35px] flex bg-gray-100 rounded-lg justify-center items-center hover:bg-gray-200 duration-200">-->
<!--									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"-->
<!--										 stroke-width="1.5"-->
<!--										 stroke="currentColor" class="w-6 h-6">-->
<!--										<path stroke-linecap="round" stroke-linejoin="round"-->
<!--											  d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>-->
<!--									</svg>-->
<!--								</a>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div v-if="block.type === 'linkTool'">-->
<!--							<div v-if="block.data.meta.type === 'post'" class="w-full mx-auto">-->
<!--								<a class="group relative block rounded-xl dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" :href="block.data.link">-->
<!--										<div class="flex-shrink-0 relative w-full rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:w-full before:h-full before:bg-gradient-to-t before:from-gray-900/[.7] before:z-[1]">-->
<!--										</div>-->

<!--										<div class="absolute top-0 inset-x-0 z-10">-->
<!--											<div class="p-4 flex flex-col h-full sm:p-6">-->
<!--												&lt;!&ndash; Avatar &ndash;&gt;-->
<!--												<div class="flex items-center">-->
<!--													<div class="ms-2.5 sm:ms-4">-->
<!--														<h4 class="font-semibold text-white">-->
<!--															{{ block.data.meta.data.authors[0].name }}-->
<!--														</h4>-->
<!--														<p class="text-xs text-white/[.8]">-->
<!--															{{ block.data.meta.data.created_post }}-->
<!--														</p>-->
<!--													</div>-->
<!--												</div>-->
<!--												&lt;!&ndash; End Avatar &ndash;&gt;-->
<!--											</div>-->
<!--										</div>-->

<!--										<div class="absolute bottom-0 inset-x-0 z-10">-->
<!--											<div class="flex flex-col h-full p-4 sm:p-6">-->
<!--												<h3 class="text-lg sm:text-3xl font-semibold text-white group-hover:text-white/[.8]">-->
<!--													{{ block.data.meta.data.title }}-->
<!--												</h3>-->
<!--												<p class="mt-2 text-white/[.8]">-->
<!--													{{ textLimit(block.data.meta.description, 200) }}-->
<!--												</p>-->
<!--											</div>-->
<!--										</div>-->
<!--									</a>-->
<!--							</div>-->
<!--							&lt;!&ndash; End Card Blog &ndash;&gt;-->
<!--							<div v-if="block.data.meta.type === 'student'" class="flex flex-col rounded-xl p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">-->
<!--								<div class="flex items-center gap-x-4">-->
<!--									<img loading="lazy" class="rounded-xl w-[150px]" :src="block.data.meta.data.photo" alt="Image Description">-->
<!--									<div class="grow">-->
<!--										<Link :href="block.data.link" class="font-medium text-gray-800 hover:text-gray-500 underline">-->
<!--											{{ block.data.meta.title }}-->
<!--										</Link>-->
<!--										<p class="text-xs text-gray-500 mt-2">-->
<!--											{{ block.data.meta.data.position }}-->
<!--										</p>-->
<!--										<p class="text-xs text-gray-500 mt-2">-->
<!--											{{ block.data.meta.data.contactEmail }} / <a :href="block.data.meta.data.vk_link">Вконтакте</a>-->
<!--										</p>-->
<!--									</div>-->
<!--								</div>-->

<!--								&lt;!&ndash; Social Brands &ndash;&gt;-->
<!--								&lt;!&ndash; End Social Brands &ndash;&gt;-->
<!--							</div>-->
<!--						</div>-->

<!--					</template>-->
				</div>


			</div>
		</article>
	</div>

	<ClientFooterDown />


	<FsLightbox class="z-1000" :slide="slide" :toggler="toggler" :sources="editorImages"/>


</template>

<script>


import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import FsLightbox from "fslightbox-vue/v3";
import MainNavbar from "@/Navbars/MainNavbar.vue";
import ClientFooterDown from "@/Components/ClientFooterDown.vue";
import { Head } from '@inertiajs/vue3'
import slugify from "slugify";
import axios from "axios";


export default {
	name: "Page",
	data() {
		return {
			scrollTop: false,
			currentNavSection: null,
		}
	},
	
	props: {
		department: {
			type: Object,
		},
		departments: {
			type: Object
		},
	},

	components: {
		ClientFooterDown,
		MainNavbar,
		AdminLayout,
		Link,
		FsLightbox,
		Head
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
		openEditorImagesOnSlide: function (number) {
			this.slide = number;
			this.toggler = !this.toggler;
		},
		isSameRoute(route) {
			if (this.$page.props.ziggy.location === route) {
				return true
			}
		},
		generateSlug: function (text) {
			return slugify(text, {
				lower: true,
				strict: true,
				locale: 'ru'
			});
		},
		onScroll(e) {
			const windowTop = window.top.scrollY
			if (windowTop > 100) {
				this.scrollTop = true
			} else {
				this.scrollTop = false
			}
		},
		scrollToTop() {
			window.scrollTo(0, 0)
		},


	},
	mounted() {
		window.addEventListener("scroll", this.onScroll)

		// this.editorImages = this.blocksWithSlideNumber.filter(block => block.type === 'image').map(block => block.data.file.url);

		window.addEventListener("scroll", () => {
			const headings = document.querySelectorAll('h2');
			const visor = document.querySelector('#visor');
			let lastVisibleHeading = null;

			const visorRect = visor.getBoundingClientRect();

			// Проверяем, находится ли визор в пределах видимости
			if (visorRect.top > window.scrollY) {
				this.currentNavSection = null;
				lastVisibleHeading = null; // Сбрасываем заголовок, если визор не виден
				return; // Выходим из функции, если визор не виден
			}

			for (let i = 0; i < headings.length; i++) {
				const heading = headings[i];
				const rect = heading.getBoundingClientRect();

				// Проверяем, находится ли заголовок в видимой области и касается ли он элемента visor
				if (rect.top >= 0 && rect.bottom <= window.innerHeight && rect.bottom >= visorRect.top && rect.top <= visorRect.bottom) {
					// Проверяем, изменился ли заголовок
					if (heading !== lastVisibleHeading) {
						this.currentNavSection = heading.id;
						lastVisibleHeading = heading;
					}
					break; // Выходим из цикла, если нашли видимый заголовок
				}
			}
		});


	},
	beforeDestroy() {
		window.removeEventListener('scroll', this.handleScroll);
		window.removeEventListener("scroll", this.onScroll)
	},

	computed: {
	}
}
</script>

<style>


.paragraph-container a {
	@apply text-[#1E57A3];
	@apply underline;
}

.paragraph-container p {
	@apply mb-2
}



@keyframes fade {
	from {
		opacity: 0;
	}
	to {
		opacity: 1;
	}
}

.fade-enter-active,
.fade-leave-active {
	transition: all 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
	opacity: 0;
}

@keyframes grow-progress {
	from { transform: scaleX(0); }
	to { transform: scaleX(1); }
}

#progress {
	height: 2px;
	background: #26ACB8;
	z-index: 10000;

	transform-origin: 0 50%;
	animation: grow-progress auto linear;
	animation-timeline: scroll();
}


.active {
	color: blue !important;
}

.example-initial-animation {
	animation: initial-animation 2s ease;
}

@keyframes initial-animation {
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
