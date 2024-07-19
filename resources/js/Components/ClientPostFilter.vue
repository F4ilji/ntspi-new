<template>
	<div class="sm:col-span-2 md:grow">
		<!--Фильтр-->
		<div class="flex justify-end gap-x-2">
			<div class="hs-dropdown relative inline-block [--placement:bottom-right]"
				 data-hs-dropdown-auto-close="inside">
				<button id="hs-as-table-table-filter-dropdown" type="button"
						class="py-3 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
					<svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16"
						 height="16" fill="currentColor" viewBox="0 0 16 16">
						<path
								d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
					</svg>
					Фильтры
				</button>
				<div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mt-2 divide-y divide-gray-200 min-w-[12rem] z-10 bg-white shadow-md rounded-lg mt-2 dark:divide-gray-700 dark:bg-gray-800 dark:border dark:border-gray-700"
						aria-labelledby="hs-as-table-table-filter-dropdown">
					<div class="divide-y divide-gray-200 dark:divide-gray-700">
						<label for="inp0" class="flex py-2.5 px-3">
							<input v-model="category_id" value="" v-on:change="clearFilter" type="radio" name="hs-radio-group"
								   class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
								   id="inp0" checked>
							<span class="ml-3 text-sm text-gray-800 dark:text-gray-200">Все</span>
						</label>
						<label v-for="item in items.data" :key="item.id" :for="'inp' + item.id" class="flex py-2.5 px-3">
							<input v-model="category_id" :value="item.id" v-on:change="filter" type="radio" name="hs-radio-group"
								   class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
								   :id="'inp' + item.id">
							<span class="ml-3 text-sm text-gray-800 dark:text-gray-200">{{ item.title }}</span>
						</label>
					</div>
				</div>
			</div>
		</div>
		<!--Конец Фильтра-->
	</div>

</template>

<script>

export default {
	name: "ClientPostFilter",
    	data() {
		return {
            category_id: this.$page.props.filters.category_id,
		}
	},
	methods: {
		filter() {
            let url = new URL(window.location.href);
            url.searchParams.delete('page');
            let newUrl = url.toString();
            this.$inertia.visit(newUrl,{
				method: 'get',
                data: {
					category: this.category_id,
				},
			});
		},
		clearFilter() {
			let url = new URL(window.location.href);
            url.searchParams.delete('category');
            let newUrl = url.toString();
            this.$inertia.visit(newUrl,{
				method: 'get',
			});
		},
	},

	props: [
		'items',
	],
}
</script>

<style scoped>

</style>