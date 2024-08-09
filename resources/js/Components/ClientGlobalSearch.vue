<template>
	<div class="sm:col-span-1 w-full">
			<div v-if="result !== null && result.length !== 0" class="relative px-3 pt-3 flex justify-start items-center">
				<button :class="selectedCategory === 'All' ? 'bg-blue-50 text-blue-500 border-blue-300' : ''" @click="selectedCategory = 'All'" class="hover:bg-gray-50 duration-150 border border-[#EAEAEA] rounded font-light text-[13px] px-1 mr-2" type="button">Все</button>
				<button v-if="result && result.Post" :class="selectedCategory === 'Post' ? 'bg-blue-50 text-blue-500 border-blue-300' : ''" @click="selectedCategory = 'Post'" class="hover:bg-gray-50 duration-150 border border-[#EAEAEA] rounded font-light text-[13px] px-1 mr-2" type="button"><span class="hidden">{{ result.Post.length }}</span> Новости</button>
				<button v-if="result && result.Page" :class="selectedCategory === 'Page' ? 'bg-blue-50 text-blue-500 border-blue-300' : ''" @click="selectedCategory = 'Page'" class="hover:bg-gray-50 duration-150 border border-[#EAEAEA] rounded font-light text-[13px] px-1 mr-2" type="button"><span class="hidden">{{ result.Page.length }}</span> Страницы</button>
				<button v-if="result && result.EducationalGroup" :class="selectedCategory === 'EducationalGroup' ? 'bg-blue-50 text-blue-500 border-blue-300' : ''" @click="selectedCategory = 'EducationalGroup'" class="hover:bg-gray-50 duration-150 border border-[#EAEAEA] rounded font-light text-[13px] px-1 mr-2" type="button"><span class="hidden">{{ result.EducationalGroup.length }}</span> Расписание</button>

			</div>
		<div class="relative px-1 py-2 flex justify-between items-center">
			<input autofocus="autofocus" autocomplete="off" @input="search" v-model="searchInput" type="text"
						 id="hs-as-table-product-review-search"
						 name="hs-as-table-product-review-search"
						 class="py-1 placeholder-[#8F8F8F] font-light px-2 block flex-1 w-full border-none text-lg focus:z-10 border-transparent focus:border-transparent focus:ring-0"
						 placeholder="Поиск по сайту">
			<button data-hs-overlay="#hs-basic-modal" class="hover:bg-gray-50 duration-150 border border-[#EAEAEA] rounded font-light text-[13px] px-1 mr-4" type="button">Esc</button>
		</div>
		<hr class="bg-gray-300">
		<div v-if="result === null" class="px-2 font-light">
			<Link data-hs-overlay="#hs-basic-modal" :href="route('client.post.index')" class="my-1 flex gap-3 px-2 py-2 items-center hover:bg-[#F2F2F2] rounded-lg">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
					<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
				</svg>
				<span class="text-sm">Новости</span>
			</Link>
			<Link data-hs-overlay="#hs-basic-modal" :href="'#'" class="my-1 flex gap-3 px-2 py-2 items-center hover:bg-[#F2F2F2] rounded-lg">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
				</svg>

				<span class="text-sm">Мероприятия</span>
			</Link>
			<Link data-hs-overlay="#hs-basic-modal" :href="'#'" class="my-1 flex gap-3 px-2 py-2 items-center hover:bg-[#F2F2F2] rounded-lg">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
				</svg>

				<span class="text-sm">Приемная компания</span>
			</Link>
			<Link data-hs-overlay="#hs-basic-modal" :href="route('client.program.bakalavriat')" class="my-1 flex gap-3 px-2 py-2 items-center hover:bg-[#F2F2F2] rounded-lg">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
				</svg>

				<span class="text-sm">Образовательные программы</span>
			</Link>
			<Link data-hs-overlay="#hs-basic-modal" :href="'#'" class="my-1 flex gap-3 px-2 py-2 items-center hover:bg-[#F2F2F2] rounded-lg">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
				</svg>

				<span class="text-sm">Курсы дополнительного образования</span>
			</Link>
		</div>
		<div v-else-if="result.length !== 0" class="px-2 font-light h-80 overflow-y-auto">
			<template v-for="(elements, tag) in result">
					<template v-for="item in elements">
						<template v-if="selectedCategory === 'All' || selectedCategory === tag">
							<Link v-if="item.tag === 'Post'" data-hs-overlay="#hs-basic-modal" :href="route('client.post.show', item.data.slug)" class="my-1 flex gap-3 px-2 py-2 items-center hover:bg-[#F2F2F2] rounded-lg">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
								</svg>
								<span class="text-sm">{{ item.data.title }}</span>
							</Link>
						</template>
						<template v-if="selectedCategory === 'All' || selectedCategory === tag">
							<div v-if="item.tag === 'EducationalGroup'" data-hs-overlay="#hs-basic-modal" class="my-1 flex gap-3 px-2 py-2 items-center rounded-lg">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
									<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
								</svg>
								<span class="text-sm">{{ item.data.title }}</span>
							</div>
							<template v-for="schedule in item.data.schedules">
								<div class="mb-2">
									<div class="flex gap-3 px-2 items-center hover:bg-[#F2F2F2] rounded-lg">
										<Link :href="rou" class="ml-[8px] flex h-12 w-full items-center gap-2 overflow-hidden border-l border-gray-200 px-4 pl-[22px] text-sm text-gray-900 md:h-10">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
												<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
											</svg>
											<p class="truncate">{{ schedule.title }}</p>
										</Link>
									</div>
								</div>
							</template>
						</template>
						<template v-if="selectedCategory === 'All' || selectedCategory === tag">
							<Link v-if="item.tag === 'Page' && item.data.is_url == false" data-hs-overlay="#hs-basic-modal" :href="route('page.view', item.data.path) + '/'" class="my-1 flex gap-3 px-2 py-2 items-center hover:bg-[#F2F2F2] rounded-lg">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
								</svg>
								<span class="text-sm">{{ item.data.title }}</span>
							</Link>
							<a v-if="item.tag === 'Page' && item.data.is_url == true" data-hs-overlay="#hs-basic-modal" :href="item.data.path" class="my-1 flex gap-3 px-2 py-2 items-center hover:bg-[#F2F2F2] rounded-lg">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
								</svg>
								<span class="text-sm">{{ item.data.title }}</span>
							</a>
						</template>
						<div v-if="item.matches.length != 0 && selectedCategory === 'All' || selectedCategory === tag" class="mb-2">
							<template v-for="match in item.matches.slice(0,3)">
								<div class="flex gap-3 px-2 items-center hover:bg-[#F2F2F2] rounded-lg">
									<div class="ml-[8px] flex h-12 w-full items-center gap-2 overflow-hidden border-l border-gray-200 px-4 pl-[22px] text-sm text-gray-900 md:h-10">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
											<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
										</svg>
										<p class="truncate">{{ match }}</p>
									</div>
								</div>
							</template>
						</div>
					</template>
			</template>
		</div>
	</div>
</template>

<script>
import {debounce} from "lodash/function.js";
import {Link} from "@inertiajs/vue3";
import {Inertia} from "@inertiajs/inertia";
export default {
	name: "ClientGlobalSearch",
	data() {
		return {
			searchInput: "",
			result: null,
			selectedCategory: 'All',
		}
	},
	components: {
		Link,
	},
	methods: {
		search: debounce(function () {
			axios({
				method: "get",
				url: route('client.search.index'),
				params: {
					search: this.searchInput.toLowerCase(),
				}
			}).then((response) => {
				this.result = response.data.searchRes;
				console.log(this.result)
			});
		}, 500),
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

<style scoped>


</style>