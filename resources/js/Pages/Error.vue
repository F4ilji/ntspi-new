<template>
	<Head>
		<title>Ошибка {{ title }}</title>
		<meta name="description" content="Your page description">
	</Head>





	<div class="max-w-[50rem] flex flex-col mx-auto size-full">
		<!-- ========== HEADER ========== -->
		<!-- ========== END HEADER ========== -->

		<!-- ========== MAIN CONTENT ========== -->
		<main class="mt-[67px]" id="content">
			<div class="text-center py-10 px-4 sm:px-6 lg:px-8">
				<h1 class="block text-7xl font-bold text-gray-800 sm:text-9xl">{{ title }}</h1>
				<p class="mt-3 text-gray-600">Упс! Что-то пошло не так.</p>
				<p class="text-gray-600">{{ description }}</p>
				<div class="mt-5 flex flex-col justify-center items-center gap-2 sm:flex-row sm:gap-3">
					<a :href="route('index')" class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="../examples.html">
						<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
						На домашнюю страницу
					</a>
				</div>
			</div>
		</main>
		<!-- ========== END MAIN CONTENT ========== -->

		<!-- ========== FOOTER ========== -->

		<!-- ========== END FOOTER ========== -->
	</div>

	<ClientFooterDown />




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
	name: "Error",
	data() {
		return {

		}
	},

	props: {
		status: Number,
		mainSections: Array,
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



	},
	computed: {
		title() {
			return {
				503: '503',
				500: '500',
				404: '404',
				403: '403',
			}[this.status]
		},
		description() {
			return {
				503: 'Мы проводим технические работы, вернитесь пожалуйста позже!',
				500: 'Не расстраивайтесь, скоро мы исправим эту ошибку!',
				404: 'Кажется страница не найдена',
				403: 'А вам сюда нельзя',
			}[this.status]
		},
	},
}
</script>

<style scoped>






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
