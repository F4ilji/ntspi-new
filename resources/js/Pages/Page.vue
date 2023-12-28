<template>
	<Head>
		<title>{{ page.data.title }}</title>
		<meta name="description" content="Your page description">
	</Head>
	<MainNavbar class="border-b" :sections="this.mainSections" />


	<div class="w-full h-[67px] fixed" id="visor"></div>

	<div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
		<div class="sticky top-[121px] hidden h-[calc(100vh-121px)] min-w-[20%] md:flex md:shrink-0 md:flex-col md:justify-between">
			<nav v-if="this.subSectionPages"
				 class="styled-scrollbar flex h-[calc(100vh-200px)] flex-col overflow-y-scroll pr-2 pb-4">
				<div class="text-gray-1000 mb-2 text-md font-medium">{{ page.data.section }}</div>
				<div class="flex gap-x-1">
					<ul class="px-0.5 last-of-type:mb-0 mb-8">
						<li v-for="page in this.subSectionPages.data" class="my-1.5 flex">
							<a :class="{'text-white hover:text-gray-200 font-semibold bg-[#2C6288]': isSameRoute(page.path), 'text-gray-600 hover:text-[#26ACB8]': !isSameRoute(page.path) }"
							   :href="page.path"
							   class="relative duration-300 flex w-full rounded-md cursor-pointer items-centerp px-2 py-1 text-left text-sm">{{
									page.title
								}}</a>
						</li>
					</ul>
				</div>

			</nav>
		</div>
		<nav class="order-last hidden w-56 shrink-0 lg:block">
			<div class="sticky top-[126px] h-[calc(100vh-121px)]">
				<div class="text-gray-1000 mb-2 text-md font-medium">На этой странице</div>
				<ul class="styled-scrollbar max-h-[70vh] space-y-1.5 overflow-y-auto py-2 text-sm">
					<li class="anchor-li" v-for="pageNav in headerNavs">
						<a :class="{ 'translate-x-2 text-[#26ACB8]' : currentNavSection === generateSlug(pageNav.text), 'bg-transperant text-gray-600 hover:text-gray-900' : currentNavSection !== generateSlug(pageNav.text) }"
						   class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
						   :href="'#' + generateSlug(pageNav.text)">{{ pageNav.text }}</a>
					</li>
					<transition name="fade">
						<li class="anchor-li flex items-center py-2 border-t" v-if="scrollTop" @click.prevent="scrollToTop">
							<a class="bg-transperant text-gray-600 cursor-pointer hover:text-gray-900 duration-300 block px-2 leading-[1.6] rounded-md">К началу</a>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[17px] text-gray-600">
								<path stroke-linecap="round" stroke-linejoin="round" d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</li>
					</transition>
				</ul>
			</div>
		</nav>
		<article class="w-full min-w-0 mt-4 max-w-6xl px-1 md:px-6" style="">
			<div class="space-y-5 md:space-y-5">
				<div class="flex justify-between pb-4 items-center mb-6">
					<div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">
						<div class="grow">
							<div class="grid sm:flex sm:justify-between sm:items-center gap-2">
								<ol v-if="breadcrumbs" class="flex items-center whitespace-nowrap min-w-0"
									aria-label="Breadcrumb">
									<li class="text-sm">
										<a class="flex items-center text-gray-500 hover:text-blue-600" href="/">
											Главная
											<svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400"
												 width="16" height="16"
												 viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
													  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
											</svg>
										</a>
									</li>
									<li class="text-sm">
										<a class="flex items-center text-gray-500 hover:text-blue-600" @click.prevent>
											{{ this.breadcrumbs.mainSection }}
											<svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400"
												 width="16" height="16"
												 viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
													  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
											</svg>
										</a>
									</li>
									<li class="text-sm">
										<a class="flex items-center text-gray-500 hover:text-blue-600" @click.prevent>
											{{ this.breadcrumbs.subSection }}
											<svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400"
												 width="16" height="16"
												 viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
													  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
											</svg>
										</a>
									</li>
									<li class="text-sm">
										<a class="flex items-center text-gray-500 hover:text-blue-600" @click.prevent>
											{{ this.breadcrumbs.page }}
										</a>
									</li>
								</ol>
								<ol v-if="!breadcrumbs" class="flex items-center whitespace-nowrap min-w-0"
									aria-label="Breadcrumb">
									<li class="text-sm">
										<a class="flex items-center text-gray-500 hover:text-blue-600" href="/">
											Главная
											<svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400"
												 width="16" height="16"
												 viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
													  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
											</svg>
										</a>
									</li>
									<li class="text-sm">
										<a class="flex items-center text-gray-500 hover:text-blue-600" @click.prevent>
											{{ this.page.data.title }}
										</a>
									</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="space-y-3">
					<h1 class="text-2xl font-bold md:text-3xl">{{ page.data.title }}</h1>
				</div>

				<div id="scrollspy" class="space-y-5 md:space-y-5">
					<template v-for="block in blocksWithSlideNumber">
						<div class="smooth-emerging" v-if="block.type === 'image'">
							<figure>
								<img loading="lazy" @click="openEditorImagesOnSlide(block.slideNumber)"
									 :src="block.data.file.url"
									 class="w-full max-h-[350px] object-cover rounded-lg hover:opacity-95 hover:duration-200 transition"
									 :alt="block.data.caption">
								<figcaption class="mt-3 text-sm text-center text-gray-500">
									{{ block.data.caption }}
								</figcaption>
							</figure>
						</div>
						<div class="smooth-emerging" v-if="block.type === 'header'">
							<h2 :id="generateSlug(block.data.text)" class="font-bold text-xl mt-10">{{ block.data.text }}</h2>
						</div>
						<div class="smooth-emerging" v-if="block.type === 'paragraph'">
							<p v-html="block.data.text"
							   class="text-[16px] text-gray-700  leading-7"></p>
						</div>
						<div v-if="block.type === 'list'">
							<ul class="list-outside" :class="{ 'list-disc': block.data.style === 'unordered'  }">
								<li class="ml-5 text-[16px] mt-2 text-gray-700  leading-7 smooth-emerging"
									v-for="item in block.data.items"
									v-html="item"></li>
							</ul>
						</div>
						<div class="smooth-emerging" v-if="block.type === 'attaches'">
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
						<div class="smooth-emerging" v-if="block.type === 'linkTool'">
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
							<div v-if="block.data.meta.type === 'person'" class="flex flex-col rounded-xl p-4 md:p-6 bg-white border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
								<div class="flex items-center gap-x-4">
									<img loading="lazy" class="rounded-xl w-[150px]" :src="block.data.meta.data.photo" alt="Image Description">
									<div class="grow">
										<Link :href="block.data.link" class="font-medium text-gray-800 hover:text-gray-500 underline">
											{{ block.data.meta.title }}
										</Link>
										<p class="text-xs text-gray-500 mt-2">
											{{ block.data.meta.data.administrativePosition }} / {{ block.data.meta.data.educatorPosition }}
										</p>
										<p class="text-xs text-gray-500 mt-2">
											{{ block.data.meta.data.contactPhone }} / {{ block.data.meta.data.contactEmail }}
										</p>
									</div>
								</div>

								<!-- Social Brands -->
								<!-- End Social Brands -->
							</div>
						</div>

						<div class="flex gap-x-5 justify-between" v-if="block.type === 'columns'">
							<div class="w-1/2" v-for="col in block.data.cols" :key="col.time">
								<div class="gap-5" v-if="col.blocks && col.blocks.length > 0">
									<div v-for="block in col.blocks" :key="block.id">
										<div v-if="block.type === 'image'">
											<figure>
												<img loading="lazy" @click="openEditorImagesOnSlide(block.slideNumber)"
													 :src="block.data.file.url"
													 class="w-full h-[300px] object-cover rounded-xl hover:opacity-95 hover:duration-200 transition"
													 :alt="block.data.caption">
												<figcaption class="mt-3 text-sm text-center text-gray-500">
													{{ block.data.caption }}
												</figcaption>
											</figure>
										</div>
										<div v-if="block.type === 'header'">
											<h2 :id="'header_' + block.id" class="font-bold text-xl mt-10">
												{{ block.data.text }}</h2>
										</div>
										<div v-if="block.type === 'paragraph'">
											<p v-html="block.data.text"
											   class="text-[16px] text-gray-700  leading-relaxed"></p>
										</div>
										<div v-if="block.type === 'list'">
											<ul class="list-outside"
												:class="{ 'list-disc': block.data.style === 'unordered'  }">
												<li class="ml-5 text-[16px] text-gray-700  leading-loose"
													v-for="item in block.data.items"
													v-html="item"></li>
											</ul>
										</div>
										<div v-if="block.type === 'attaches'">
											<div class="flex border rounded-lg px-4 py-2 items-center justify-between">
												<div class="flex items-center">
													<div class="w-[35px] h-[35px] bg-black flex justify-center items-center rounded-xl mr-2">
														<svg xmlns="http://www.w3.org/2000/svg" fill="none"
															 viewBox="0 0 24 24" stroke-width="1.5"
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
													<svg xmlns="http://www.w3.org/2000/svg" fill="none"
														 viewBox="0 0 24 24" stroke-width="1.5"
														 stroke="currentColor" class="w-6 h-6">
														<path stroke-linecap="round" stroke-linejoin="round"
															  d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
													</svg>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>


						</div>
					</template>
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


export default {
	name: "Page",
	data() {
		return {
			blocks: this.blocksWithSlideNumber,
			userData: this.$page.props.auth.user,
			toggler: false,
			editorImages: [],
			galleryImages: [],
			slide: 1,
			pageNavs: this.getPageNavs,
			currentNavSection: null,
			scrollTop: false,
			headerNavs: this.page.data.content.blocks.filter(block => block.type === 'header').map(block => ({ id: block.id, text: block.data.text }))
		}
	},

	props: [
		'page',
		'mainSections',
		'subSectionPages',
		'breadcrumbs'
	],
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
			if (this.$page.props.ziggy.location === this.$page.props.ziggy.url + '/' + route) {
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
		}

	},
	mounted() {
		window.addEventListener("scroll", this.onScroll)

		this.editorImages = this.blocksWithSlideNumber.filter(block => block.type === 'image').map(block => block.data.file.url);

		const links = document.querySelectorAll('a:not([href^="#"]):not([download])');

		links.forEach(link => {
			link.addEventListener('click', (event) => {
				// Отменяем стандартное поведение браузера при клике на ссылку
				event.preventDefault();

				// Получаем URL ссылки
				const url = link.getAttribute('href');

				// Переходим на новую страницу с помощью pushState()
				this.$inertia.visit(url)
			});
		});

		const headings = document.querySelectorAll('h2');
		const visor = document.querySelector('#visor');
		let lastVisibleHeading = null;

		window.addEventListener('scroll', () => {
			for (let i = 0; i < headings.length; i++) {
				const heading = headings[i];
				const rect = heading.getBoundingClientRect();
				const visorRect = visor.getBoundingClientRect();

				// Проверяем, находится ли заголовок в видимой области и касается ли он элемента visor
				if (rect.top >= 0 && rect.bottom <= window.innerHeight && rect.bottom >= visorRect.top && rect.top <= visorRect.bottom) {
					// Проверяем, изменился ли заголовок
					if (heading !== lastVisibleHeading) {
						this.currentNavSection = heading.id;
						lastVisibleHeading = heading;
					}
					break;
				}
			}
		});


	},
	beforeDestroy() {
		window.removeEventListener('scroll', this.handleScroll);
		window.removeEventListener("scroll", this.onScroll)
	},

	computed: {
		blocksWithSlideNumber() {
			let slideNumber = 1;
			return this.page.data.content.blocks.map((block) => {
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
.smooth-emerging {
	animation: fade linear both !important;
	animation-timeline: view() !important;
	animation-range: entry 10% cover 20% !important;
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
