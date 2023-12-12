<template>
	<div class="sm:col-span-2 md:grow">
		<!--Фильтр-->
		<div class="flex justify-end gap-x-2">
			<div class="hs-dropdown relative inline-block [--placement:bottom-right]"
				 data-hs-dropdown-auto-close="inside">
				<button id="hs-as-table-table-filter-dropdown" type="button"
						class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
					<svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16"
						 height="16" fill="currentColor" viewBox="0 0 16 16">
						<path
								d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
					</svg>
					Фильтр
					<span
							class="pl-2 text-xs font-semibold text-blue-600 border-l border-gray-200 dark:border-gray-700 dark:text-blue-500">
                                                    1
                                                </span>
				</button>
				<div
						class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mt-2 divide-y divide-gray-200 min-w-[12rem] z-10 bg-white shadow-md rounded-lg mt-2 dark:divide-gray-700 dark:bg-gray-800 dark:border dark:border-gray-700"
						aria-labelledby="hs-as-table-table-filter-dropdown">
					<div class="divide-y divide-gray-200 dark:divide-gray-700">
						<label for="hs-radio-group-1" class="flex py-2.5 px-3">
							<input type="radio" name="hs-radio-group"
								   class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
								   id="hs-radio-group-1" checked>
							<span class="ml-3 text-sm text-gray-800 dark:text-gray-200">Все</span>
						</label>
						<label for="hs-radio-group-2" class="flex py-2.5 px-3">
							<input type="radio" name="hs-radio-group"
								   class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
								   id="hs-radio-group-2">
							<span class="ml-3 text-sm text-gray-800 dark:text-gray-200">Опубликованы</span>
						</label>
						<label for="hs-radio-group-3" class="flex py-2.5 px-3">
							<input disabled type="radio" name="hs-radio-group"
								   class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
								   id="hs-radio-group-3">
							<span class="ml-3 text-sm text-gray-800 dark:text-gray-200">На рассмотрении</span>
						</label>
						<label for="hs-radio-group-4" class="flex py-2.5 px-3">
							<input type="radio" name="hs-radio-group"
								   class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
								   id="hs-radio-group-4">
							<span class="ml-3 text-sm text-gray-800 dark:text-gray-200">Не активны</span>
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
	name: "AdminIndexFilter",
	data() {
		return {
		}
	},
	methods: {
	},
	props: [
	],
}
</script>

<style scoped>

</style>