<template>
	<Head>
		<title>{{ person.data.name }}</title>
		<meta name="description" content="Your page description">
	</Head>
	<MainNavbar class="border-b" :sections="$page.props.navigation" />

	<div class="w-full h-[67px] fixed" id="visor"></div>

	<div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">

		<nav class="order-last hidden w-56 shrink-0 lg:block">
			<div class="sticky top-[110px] h-[calc(100vh-110px)]">
				<div class="text-gray-1000 mb-2 text-md font-medium">На этой странице</div>
				<ul class="styled-scrollbar max-h-[70vh] space-y-1.5 overflow-y-auto py-2 text-sm">
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'education', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'education' }"
						   class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
						   href="#education">Образование
						</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'awards', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'awards' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#awards">Награды</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'professionalRetraining', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'professionalRetraining' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#professionalRetraining">Профессиональная переподготовка
						</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'professionalDevelopment', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'professionalDevelopment' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#professionalDevelopment">Повышение квалификации
						</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'professDisciplines', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'professDisciplines' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#professDisciplines">Преподаваемые дисциплины
						</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'workExperience', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'workExperience' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#workExperience">Стаж работы
						</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'attendedConferences', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'attendedConferences' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#attendedConferences">Участие в конференциях
						</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'participationScienceProjects', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'participationScienceProjects' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#participationScienceProjects">Участие в научных проектах
						</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'publications', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'publications' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#publications">Публикации
						</a>
					</li>
					<li class="anchor-li">
						<a :class="{ 'translate-x-2 text-[#135aae]' : this.currentNavSection  === 'other', 'bg-transperant text-gray-600 hover:text-gray-900' : this.currentNavSection !== 'other' }"
							 class="duration-150 block py-1 px-2 leading-[1.6] rounded-md"
							 href="#other">Другое
						</a>
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
			<div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
				<!-- Profile -->
				<div class="flex items-center gap-x-10">
					<div class="shrink-0">
						<img class="shrink-0 w-[200px] h-[300px] rounded-xl object-cover" :src="'/storage/' + person.data.details.photo" alt="Avatar">						{{ }}
					</div>

					<div class="grow">
						<h1 class="text-2xl font-medium text-gray-800 dark:text-neutral-200">
							{{ person.data.name }}
						</h1>
						<div class="">
							<template v-for="division_work in person.data.divisions_works">
								<Link :href="route('client.division.show', division_work.slug)" class="text-sm text-blue-500 dark:text-neutral-400 mr-2">
									{{ division_work.position }}
								</Link>
							</template>
							<template v-for="faculty_work in person.data.faculties_works">
								<Link :href="route('client.faculty.show', faculty_work.slug)" class="text-sm text-blue-500 dark:text-neutral-400 mr-2">
									{{ faculty_work.position }}
								</Link>
							</template>
							<template v-for="division_work in person.data.departments_work">
								<Link :href="route('client.department.show', { facultySlug: division_work.faculty_slug, departmentSlug: division_work.slug })" class="text-sm text-blue-500 dark:text-neutral-400 mr-2">
									{{ division_work.position }}
								</Link>
							</template>
							<template v-for="division_tech in person.data.departments_teach">
								<Link :href="route('client.department.show', { facultySlug: division_tech.faculty_slug, departmentSlug: division_tech.slug })" class="text-sm text-blue-500 dark:text-neutral-400 mr-2">
									{{ division_tech.position }}
								</Link>
							</template>
						</div>

						{{ console.log(person) }}

						<ul class="mt-5 flex flex-col gap-y-3">

							<li class="flex items-center gap-x-2.5">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 size-3.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
								</svg>

								<a class="text-[13px] text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="#">
									{{ person.data.details.contactPhone }}
								</a>
							</li>
							<li class="flex items-center gap-x-2.5">
								<svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<rect width="20" height="16" x="2" y="4" rx="2"></rect>
									<path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
								</svg>
								<a class="text-[13px] text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="#">
									{{ person.data.details.contactEmail }}
								</a>
							</li>
						</ul>


					</div>
				</div>
				<!-- End Profile -->

				<div class="mt-10 sm:mt-14">
					<h2 id="education" class="mb-3 font-medium text-gray-800 dark:text-neutral-200">
						Направление подготовки
					</h2>

					<div class="grid grid-cols-1 sm:grid-cols-1 gap-3">
						<div class="p-4 border border-gray-200 rounded-lg dark:border-neutral-700">
							<h3 class="mb-1 text-xs text-gray-600 dark:text-neutral-400">
								2012 - 2013
							</h3>

							<p class="font-semibold text-sm text-gray-800 dark:text-neutral-200">
								{{ person.data.details.education }}
							</p>

							<p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
								The University of Manchester
							</p>
						</div>

					</div>

				</div>

				<div class="mt-8">
					<h2 id="awards" class="mb-3 font-medium text-gray-800 dark:text-neutral-200">
						Награды
					</h2>
					<ul class="list-disc ms-6 mt-3 space-y-1.5">
						<template v-for="award in person.data.details.awards">
							<li class="ps-1 text-sm text-gray-600 dark:text-neutral-400">
								{{ award.item }}
							</li>
						</template>
					</ul>
				</div>

				<div class="mt-8">
					<h2 id="professionalRetraining" class="mb-3 font-medium text-gray-800 dark:text-neutral-200">
						Профессиональная переподготовка
					</h2>
					<ul class="list-disc ms-6 mt-3 space-y-1.5">
						<template v-for="professionalRetraining in person.data.details.professionalRetraining">
							<li class="ps-1 text-sm text-gray-600 dark:text-neutral-400">
								{{ professionalRetraining.item }}
							</li>
						</template>
					</ul>
				</div>

				<div class="mt-8">
					<h2 id="professionalDevelopment" class="mb-3 font-medium text-gray-800 dark:text-neutral-200">
						Повышение квалификации
					</h2>
					<ul class="list-disc ms-6 mt-3 space-y-1.5">
						<template v-for="professionalDevelopment in person.data.details.professionalDevelopment">
							<li class="ps-1 text-sm text-gray-600 dark:text-neutral-400">
								{{ professionalDevelopment.item }}
							</li>
						</template>
					</ul>
				</div>

				<div class="mt-8">
					<h2 id="professDisciplines" class="mb-3 font-medium text-gray-800 dark:text-neutral-200">
						Преподаваемые дисциплины
					</h2>
					<ul class="list-disc ms-6 mt-3 space-y-1.5">
						<template v-for="professDiscipline in person.data.details.professDisciplines">
							<li class="ps-1 text-sm text-gray-600 dark:text-neutral-400">
								{{ professDiscipline.item }}
							</li>
						</template>
					</ul>
				</div>

				<div class="mt-8">
					<h2 id="workExperience" class="mb-3 font-medium text-gray-800 dark:text-neutral-200">
						Стаж
					</h2>

					<div class="grid grid-cols-1 sm:grid-cols-1 gap-3">
						<p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
							Стаж работы: {{ person.data.details.workExperience }}
						</p>
						<p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
							Стаж по специальности: {{ person.data.details.workExperience }}
						</p>
					</div>

				</div>

				<div class="mt-8">
					<h2 id="attendedConferences" class="mb-3 font-medium text-gray-800 dark:text-neutral-200">
						Участие в конференциях
					</h2>
					<ul class="list-disc ms-6 mt-3 space-y-1.5">
						<template v-for="attendedConference in person.data.details.attendedConferences">
							<li class="ps-1 text-sm text-gray-600 dark:text-neutral-400">
								{{ attendedConference.item }}
							</li>
						</template>
					</ul>
				</div>

				<div class="mt-8">
					<h2 id="participationScienceProjects" class="mb-3 font-medium text-gray-800 dark:text-neutral-200">
						Участие в научных проектах
					</h2>
					<ul class="list-disc ms-6 mt-3 space-y-1.5">
						<template v-for="participationScienceProject in person.data.details.participationScienceProjects">
							<li class="ps-1 text-sm text-gray-600 dark:text-neutral-400">
								{{ participationScienceProject.item }}
							</li>
						</template>
					</ul>
				</div>

				<div class="mt-8">
					<h2 id="publications" class="mb-3 font-medium text-gray-800 dark:text-neutral-200">
						Публикации
					</h2>
					<ul class="list-disc ms-6 mt-3 space-y-1.5">
						<template v-for="publication in person.data.details.publications">
							<li class="ps-1 text-sm text-gray-600 dark:text-neutral-400">
								{{ publication.item }}
							</li>
						</template>
					</ul>
				</div>





				<!-- About -->

				<!-- End About -->

				<!-- Projects -->
				<!-- End Projects -->

				<!-- Testimonials -->
				<!-- End Testimonials -->

				<!-- Skills -->
				<!-- End Skills -->

				<!-- Work Experience -->
				<!-- End Work Experience -->

				<!-- Education -->
				<!-- End Education -->

				<!-- Articles -->
				<div class="my-10 sm:my-14">
					<h2 class="mb-5 font-medium text-gray-800 dark:text-neutral-200">
						Articles
					</h2>

					<!-- List -->
					<ul class="space-y-10">
						<li>
							<p class="mb-2 text-sm text-gray-500 dark:text-neutral-500">
								2024
							</p>
							<h5 class="font-medium text-sm text-gray-800 dark:text-neutral-200">
								The complete guide to OKRs
							</h5>
							<p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
								How to make objectives and key results work for your company.
							</p>
							<p class="mt-1">
								<a class="text-sm text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="#">
									Continue reading
								</a>
							</p>
						</li>

						<li>
							<p class="mb-2 text-sm text-gray-500 dark:text-neutral-500">
								2024
							</p>
							<h5 class="font-medium text-sm text-gray-800 dark:text-neutral-200">
								Enhancement in Customer Engagement
							</h5>
							<p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
								With the aim of optimizing customer interactions and boosting brand loyalty, the team at Preline leveraged Mailchimp's powerful tools and expertise to deliver exceptional results.
							</p>
							<p class="mt-1">
								<a class="text-sm text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="#">
									Continue reading
								</a>
							</p>
						</li>

						<li>
							<p class="mb-2 text-sm text-gray-500 dark:text-neutral-500">
								2023
							</p>
							<h5 class="font-medium text-sm text-gray-800 dark:text-neutral-200">
								How Google Assistant now helps you record stories for kids
							</h5>
							<p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
								Google is constantly updating its consumer AI, Google Assistant, with new features.
							</p>
							<p class="mt-1">
								<a class="text-sm text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="#">
									Continue reading
								</a>
							</p>
						</li>
					</ul>
					<!-- End List -->
				</div>
				<!-- End Articles -->

				<!-- Subscribe -->
				<!-- End Subscribe -->
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
	name: "Show",
	data() {
		return {
			scrollTop: false,
			currentNavSection: null,
		}
	},
	
	props: {
		person: {
			type: Object,
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
