<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import ClientFooterDown from "@/Components/ClientFooterDown.vue";
import {debounce} from "lodash/function.js";
import {Link} from "@inertiajs/vue3";


export default {
	name: "Schedule",
	data() {
		return {
			searchInput: this.searchRequest,
		}
	},
	components: {ClientFooterDown, MainNavbar, Link},
	props: [
		'schedules',
		'mainSections',
		'searchRequest'
	],
	methods: {
		search: debounce(function () {
			this.$inertia.reload({
				method: 'get',
				data: {
					search: this.searchInput,
				},
				preserveState: true,
				replace: true,
			});
		}, 300),
	},

}
</script>

<template>
	<MainNavbar class="border-b" :sections="this.mainSections"></MainNavbar>

	<div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
		<article class="w-full min-w-0 mt-4 px-1 md:px-6">
			<div class="relative overflow-hidden">
				<div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:pb-24 sm:py-5">
					<div class="text-center">
						<h1 class="text-2xl sm:text-4xl font-bold text-gray-800 dark:text-gray-200">
							Расписание занятий
						</h1>

						<div class="text-center">
							<p class="mt-3 text-gray-600 dark:text-gray-400">
								Просто введите название группы
							</p>
						</div>


						<div class="mt-7 sm:mt-12 mx-auto max-w-xl relative">
							<!-- Form -->
							<form>
								<div class="relative z-10 space-x-3 p-3 bg-white border rounded-lg shadow-lg shadow-gray-100">
									<div class="flex justify-between">
										<div class="flex w-full">
											<label for="hs-search-article-1"
												   class="block text-sm text-gray-700 font-medium dark:text-white">
												<span class="sr-only">Поиск</span>
											</label>
											<input @keydown.enter.prevent autocomplete="off" v-model="searchInput" @input="search" type="search"
												   id="hs-search-article-1"
												   class="py-2.5 px-4 block w-full border-transparent rounded-lg"
												   placeholder="Поиск">
										</div>
									</div>
								</div>
							</form>
							<!-- End Form -->

							<!-- SVG Element -->
							<div class="hidden md:block absolute top-0 end-0 -translate-y-12 translate-x-20">
								<svg class="w-16 h-auto text-orange-500" width="121" height="135" viewBox="0 0 121 135"
									 fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5 16.4754C11.7688 27.4499 21.2452 57.3224 5 89.0164" stroke="currentColor"
										  stroke-width="10" stroke-linecap="round"/>
									<path d="M33.6761 112.104C44.6984 98.1239 74.2618 57.6776 83.4821 5"
										  stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
									<path d="M50.5525 130C68.2064 127.495 110.731 117.541 116 78.0874"
										  stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
								</svg>
							</div>
							<!-- End SVG Element -->

							<!-- SVG Element -->
							<div class="hidden md:block absolute bottom-0 start-0 translate-y-10 -translate-x-32">
								<svg class="w-40 h-auto text-cyan-500" width="347" height="188" viewBox="0 0 347 188"
									 fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M4 82.4591C54.7956 92.8751 30.9771 162.782 68.2065 181.385C112.642 203.59 127.943 78.57 122.161 25.5053C120.504 2.2376 93.4028 -8.11128 89.7468 25.5053C85.8633 61.2125 130.186 199.678 180.982 146.248L214.898 107.02C224.322 95.4118 242.9 79.2851 258.6 107.02C274.299 134.754 299.315 125.589 309.861 117.539L343 93.4426"
										  stroke="currentColor" stroke-width="7" stroke-linecap="round"/>
								</svg>
							</div>
							<!-- End SVG Element -->
						</div>
					</div>
				</div>
			</div>

			<div class="mx-auto max-w-2xl hs-accordion-group grid grid-cols-1 lg:grid-cols-2 gap-3">

				<transition-group name="fade">
					<template v-for="schedule in schedules.data" :key="schedule.id">
						<div class="hs-accordion hs-accordion-active:border-gray-200 bg-white border-b dark:hs-accordion-active:border-gray-700 dark:bg-gray-800 dark:border-transparent"
							 id="hs-active-bordered-heading-one">
							<button class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex justify-between items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-gray-200 dark:hover:text-gray-400 dark:focus:outline-none dark:focus:text-gray-400"
									aria-controls="hs-basic-active-bordered-collapse-one">
								{{ schedule.name }}
								<svg class="hs-accordion-active:hidden block w-3.5 h-3.5"
									 xmlns="http://www.w3.org/2000/svg"
									 width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
									 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M5 12h14"/>
									<path d="M12 5v14"/>
								</svg>
								<svg class="hs-accordion-active:block hidden w-3.5 h-3.5"
									 xmlns="http://www.w3.org/2000/svg"
									 width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
									 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M5 12h14"/>
								</svg>
							</button>
							<div id="hs-basic-active-bordered-collapse-one"
								 class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
								 aria-labelledby="hs-active-bordered-heading-one">
								<div class="pb-4 px-5 grid gap-3 grid-cols-1">
									<template v-for="subSchedule in schedule.subSchedules">
										<a target="_blank" :href="subSchedule.path_file"
										   class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-500 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
											{{ subSchedule.name }}
										</a>
									</template>


								</div>
							</div>
						</div>
					</template>
				</transition-group>
			</div>
		</article>
	</div>

	<ClientFooterDown style="margin-top: 300px;"/>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
	transition: all 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
	opacity: 0;
	transform: translateY(30px);
}

.gg-enter-active,
.gg-leave-active {
	transition: all 0.5s ease;
}

.gg-enter-from,
.gg-leave-to {
	opacity: 0;
	transform: translateY(30px);
}
</style>