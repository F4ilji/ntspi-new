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
			blocks: this.event.data.content,

		}
	},

	props: {
		event: {
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
		<title>{{ event.data.title }}</title>
		<meta name="description" content="Your page description">
	</Head>
	<ClientScrollTimeline/>
	<MainNavbar :sections="this.navigation"></MainNavbar>
	<div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
		<div class="max-w-4xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
			<div>
				<div class="space-y-5 md:space-y-10">
					<div class="space-y-3">
						<a onclick="history.back()"
							 class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-blue-500"
							 href="#">
							<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
									 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
									 stroke-linejoin="round">
								<path d="m15 18-6-6 6-6"/>
							</svg>
							Назад
						</a>
						<h1 class="text-brand-primary mb-3 mt-2 text-3xl font-semibold tracking-tight dark:text-white lg:text-[40px] lg:leading-tight">
							{{ event.data.title }}
						</h1>
					</div>


					<div class="flex space-x-3 text-gray-500 ">
						<div class="flex items-center gap-3">
							<div>

								<div class="flex items-center space-x-2 text-sm">
									<p v-if="event.data.is_online === 1" class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-[#E9F2FE] text-blue-600">
										Онлайн
									</p>
									<p class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-[#E9F2FE] text-blue-600">
										{{ event.data.category }}
									</p>
									<div class="col-start-2 text-center">
										<span>Адрес: {{ event.data.address }}</span>
									</div>
								</div>
							</div>
						</div>
					</div>


					<template v-for="block in this.blocks" :key="block.id">
						<div v-if="block.type === 'heading'">
							<h2 class="font-bold text-xl">{{ block.data.content }}</h2>
						</div>
						<div class="text-[16px] text-[#374151] dark:text-gray-200 leading-8 font-light" v-html="block.data.content"
								 v-if="block.type === 'paragraph'"></div>
						<div v-if="block.type === 'image'">
							<ClientImageSlider :images="block.data.url"/>
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
				<!-- End Content -->
			</div>
		</div>

	</div>
	<ClientFooterDown/>

</template>

<style>


</style>