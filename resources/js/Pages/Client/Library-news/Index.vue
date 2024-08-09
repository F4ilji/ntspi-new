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
import ClientEventSelectDate from "@/Components/ClientEventSelectDate.vue";

export default {
	name: "Index",
	components: {
		ClientEventSelectDate,
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
	props: {
		posts: {
			type: Array,
		},
	},
	methods: {},

	mounted() {
	}
};
</script>

<template>
	<Head>
		<title>Мероприятия</title>
		<meta name="description" content="Your page description"/>
	</Head>
	<MainNavbar class="border-b" :sections="$page.props.navigation"></MainNavbar>
	<div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
		<div class="px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
			<div>
				<!--        <AdminIndexHeader>-->
				<!--          <ClientPostSearch />-->
				<!--          <ClientPostFilter :items="categories"/>-->
				<!--        </AdminIndexHeader>-->
				<!-- Avatar Media -->
				<!-- End Avatar Media -->
				<!-- Content -->
				<div class="space-y-5 md:space-y-4">
					<div class="max-w-2xl text-center mx-auto mb-10 lg:mb-14">
						<h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Заметки библиотеки</h2>
						<p class="mt-1 text-gray-600 dark:text-neutral-400">We've helped some great companies brand, design and get to market.</p>
					</div>
				</div>
				<div class="container px-8 mx-auto xl:px-5 max-w-screen-md">
					<div class="my-10 sm:my-14">
						<template v-for="post in posts.data">
							<Link :href="route('client.library.news.show', post.id)" class="group sm:flex rounded-xl mb-4">
								<div class="grow">
									<div class="flex flex-col h-full">
										<div class="mb-3">
											<p class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-[12px] text-gray-600">
												{{ post.created_at }}
											</p>
											<p class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-[#E9F2FE] text-blue-600">
												{{ post.category }}
											</p>
										</div>
										<h3 class="text-lg sm:text-2xl font-semibold text-gray-800 group-hover:text-blue-600">
											{{ post.title }}
										</h3>
										<p class="mt-2 text-gray-600">
											{{ post.preview_text }}
										</p>
									</div>
								</div>
							</Link>
						</template>
						<div class="mt-10 flex items-center justify-center">
							<nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
								<Link as="button" :href="posts.links.prev" :disabled="posts.links.prev === null"
											class="relative inline-flex items-center gap-1 rounded-l-md border border-gray-300 bg-white px-3 py-2 pr-4 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 disabled:pointer-events-none disabled:opacity-40 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
											 stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-3 w-3">
										<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
									</svg>
									<span>Предыдущая</span></Link>
								<Link as="button" :href="posts.links.next" :disabled="posts.links.next === null"
											class="relative inline-flex items-center gap-1 rounded-r-md border border-gray-300 bg-white px-3 py-2 pl-4 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 disabled:pointer-events-none disabled:opacity-40 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300">
									<span>Следующая</span>
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
											 stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-3 w-3">
										<path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
									</svg>
								</Link>
							</nav>
						</div>

					</div>



				</div>
			</div>
		</div>
	</div>
	<ClientFooterDown/>
</template>

<style scoped>


</style>
